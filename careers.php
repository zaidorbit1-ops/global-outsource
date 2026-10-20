<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/backend.php';

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; script-src 'self'; connect-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'");

$jobs = [];
$jobsAvailable = false;
$applicationErrors = [];
$applicationInput = [];
$applicationFeedback = null;
backend_session_start();

if (isset($_SESSION['career_feedback'])) {
    $applicationFeedback = $_SESSION['career_feedback'];
    unset($_SESSION['career_feedback']);
}

if (database_is_configured()) {
    try {
        $jobStatement = app_database()->query("SELECT id, title, department, location, employment_type, summary, description, requirements FROM jobs WHERE status = 'open' ORDER BY published_at DESC, id DESC");
        $jobs = $jobStatement->fetchAll();
        $jobsAvailable = true;
    } catch (Throwable $exception) {
        error_log('Careers page could not load open jobs: ' . $exception->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    backend_verify_csrf();
    $applicationInput = $_POST;
    $candidateName = trim(backend_input_string($_POST, 'name'));
    $candidateEmail = trim(backend_input_string($_POST, 'email'));
    $candidatePhone = trim(backend_input_string($_POST, 'phone'));
    $candidateLetter = trim(backend_input_string($_POST, 'cover_letter'));
    $jobId = filter_var(backend_input_string($_POST, 'job_id'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $upload = $_FILES['cv'] ?? null;

    if (backend_input_string($_POST, 'fax_number_secondary') !== '') {
        $applicationErrors[] = 'Your application could not be submitted. Please try again.';
    }
    if ($candidateName === '' || backend_length($candidateName) > 120) {
        $applicationErrors[] = 'Enter your name (up to 120 characters).';
    }
    if (filter_var($candidateEmail, FILTER_VALIDATE_EMAIL) === false || backend_length($candidateEmail) > 254) {
        $applicationErrors[] = 'Enter a valid email address.';
    }
    if (backend_length($candidatePhone) > 40) {
        $applicationErrors[] = 'Phone number must be 40 characters or fewer.';
    }
    if (backend_length($candidateLetter) > 4000) {
        $applicationErrors[] = 'Your introduction must be 4,000 characters or fewer.';
    }
    if ($jobId === false) {
        $applicationErrors[] = 'Select a current job opening.';
    }
    if (!is_array($upload) || ($upload['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        $applicationErrors[] = 'Upload your CV as a PDF, DOC or DOCX file.';
    } elseif (($upload['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_INI_SIZE || ($upload['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_FORM_SIZE) {
        $applicationErrors[] = 'Your CV must be smaller than 5 MB.';
    } elseif (($upload['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        $applicationErrors[] = 'The CV upload could not be read. Please choose the file again.';
    } elseif (($upload['size'] ?? 0) > 5 * 1024 * 1024 || ($upload['size'] ?? 0) < 1) {
        $applicationErrors[] = 'Your CV must be smaller than 5 MB.';
    }

    if ($applicationErrors === [] && is_array($upload) && is_string($upload['tmp_name'] ?? null) && is_uploaded_file($upload['tmp_name'])) {
        $originalName = backend_input_string($upload, 'name');
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $allowedMimeTypes = [
            'pdf' => ['application/pdf'],
            'doc' => ['application/msword', 'application/CDFV2', 'application/x-ole-storage'],
            'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip'],
        ];
        if (!class_exists(finfo::class)) {
            $applicationErrors[] = 'CV uploads are temporarily unavailable. Please email your CV to info@globaloutsource.com.';
        } else {
            $fileInfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $fileInfo->file($upload['tmp_name']);

            if (!isset($allowedMimeTypes[$extension]) || !is_string($mimeType) || !in_array($mimeType, $allowedMimeTypes[$extension], true)) {
                $applicationErrors[] = 'The selected CV file type is not supported. Please use PDF, DOC or DOCX.';
            }
        }
    } elseif ($applicationErrors === []) {
        $applicationErrors[] = 'Upload your CV as a PDF, DOC or DOCX file.';
    }

    if ($applicationErrors === []) {
        if (!database_is_configured()) {
            $applicationErrors[] = 'Applications are temporarily unavailable. Please email your CV to info@globaloutsource.com.';
        } else {
            $storedFilePath = null;

            try {
                $database = app_database();
                $jobCheck = $database->prepare("SELECT id, title FROM jobs WHERE id = :id AND status = 'open' LIMIT 1");
                $jobCheck->execute(['id' => $jobId]);
                $selectedJob = $jobCheck->fetch();

                if (!is_array($selectedJob)) {
                    $applicationErrors[] = 'That opening is no longer available. Please select another role.';
                } else {
                    backend_record_public_submission($database, 'application');
                    $privateDirectory = __DIR__ . '/storage/private';

                    if (!is_dir($privateDirectory) && !mkdir($privateDirectory, 0750, true) && !is_dir($privateDirectory)) {
                        throw new RuntimeException('Unable to create private CV storage.');
                    }

                    $storedName = bin2hex(random_bytes(24)) . '.' . $extension;
                    $storedFilePath = $privateDirectory . '/' . $storedName;

                    if (!move_uploaded_file((string) $upload['tmp_name'], $storedFilePath)) {
                        throw new RuntimeException('Unable to store uploaded CV.');
                    }

                    $statement = $database->prepare('INSERT INTO job_applications (job_id, name, email, phone, cover_letter, cv_storage_name, cv_original_name, cv_mime_type) VALUES (:job_id, :name, :email, :phone, :cover_letter, :cv_storage_name, :cv_original_name, :cv_mime_type)');
                    $statement->execute([
                        'job_id' => $jobId,
                        'name' => $candidateName,
                        'email' => $candidateEmail,
                        'phone' => $candidatePhone,
                        'cover_letter' => $candidateLetter,
                        'cv_storage_name' => $storedName,
                        'cv_original_name' => substr(basename($originalName), 0, 180),
                        'cv_mime_type' => $mimeType,
                    ]);

                    $successMessage = 'Thank you, ' . $candidateName . '. We have received your application for ' . $selectedJob['title'] . ', and our team will review your details.';
                    if (backend_is_ajax_request()) {
                        backend_json_response(['success' => true, 'title' => 'Application received', 'message' => $successMessage]);
                    }

                    $_SESSION['career_feedback'] = ['type' => 'success', 'message' => $successMessage];
                    backend_redirect('careers#open-positions');
                }
            } catch (RuntimeException $exception) {
                if (is_string($storedFilePath) && is_file($storedFilePath)) {
                    unlink($storedFilePath);
                }

                if (str_starts_with($exception->getMessage(), 'Too many submissions.')) {
                    $applicationErrors[] = $exception->getMessage();
                } else {
                    error_log('Careers application could not be saved: ' . $exception->getMessage());
                    $applicationErrors[] = 'We could not save your application right now. Please try again later or email info@globaloutsource.com.';
                }
            } catch (Throwable $exception) {
                if (is_string($storedFilePath) && is_file($storedFilePath)) {
                    unlink($storedFilePath);
                }

                error_log('Careers application could not be saved: ' . $exception->getMessage());
                $applicationErrors[] = 'We could not save your application right now. Please try again later or email info@globaloutsource.com.';
            }

        }
    }

    if (backend_is_ajax_request() && $applicationErrors !== []) {
        backend_json_response(['success' => false, 'title' => 'Please check your application', 'errors' => $applicationErrors, 'message' => implode(' ', $applicationErrors)], 422);
    }
}

$currentPage = 'careers';
$pageTitle = 'Careers | Global Outsource';
$pageDescription = 'Grow your career with Global Outsource. Explore our people-first culture, professional growth opportunities and global impact.';
$breadcrumbItems = [
    ['label' => 'Home', 'url' => 'index'],
    ['label' => 'Careers'],
];
$pageBannerTitle = 'Careers';
$pageBannerAccent = 'at Global Outsource';
$pageBannerEyebrow = 'People. Purpose. Possibility.';
$pageBannerTagline = 'Build your career. Be part of our journey.';
$pageBannerDescription = 'Join a team where your ideas, skills and ambition can help deliver meaningful work for businesses around the world.';

$careerHighlights = [
    ['icon' => 'M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m6-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7-3h5m-2.5-2.5v5', 'title' => 'People-first', 'detail' => 'work culture'],
    ['icon' => 'M3 17 9 11l4 4 8-9m-6 0h6v6', 'title' => 'Learning &', 'detail' => 'development'],
    ['icon' => 'M12 2a10 10 0 1 0 10 10M12 2v10l7 4m-2-14v5h5', 'title' => 'Global', 'detail' => 'exposure'],
    ['icon' => 'M12 3v18m-9-9h18M5.6 5.6l12.8 12.8m0-12.8L5.6 18.4', 'title' => 'Make a real', 'detail' => 'impact'],
];

$careerBenefits = [
    ['icon' => 'M3 4h18v13H3zM8 21h8m-4-4v4m-5-9 3 3 6-6', 'title' => 'Continuous Learning', 'description' => 'Build new skills through ongoing learning, mentorship and hands-on experience.'],
    ['icon' => 'M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m6-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7 1a4 4 0 0 1 3 4v2m-2-15a4 4 0 0 1 0 8', 'title' => 'Supportive Team', 'description' => 'Work with people who value collaboration, respect and sharing knowledge.'],
    ['icon' => 'M12 2v4m0 12v4M4.9 4.9l2.8 2.8m8.6 8.6 2.8 2.8M2 12h4m12 0h4M4.9 19.1l2.8-2.8m8.6-8.6 2.8-2.8M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z', 'title' => 'Modern Tools', 'description' => 'Use current technology and thoughtful processes to do your best work.'],
    ['icon' => 'M3 17 9 11l4 4 8-9m-6 0h6v6', 'title' => 'Career Growth', 'description' => 'Take on new challenges and grow your responsibilities as you develop.'],
    ['icon' => 'M12 21s-8-4.5-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 6.5-8 11-8 11Z', 'title' => 'Work-Life Balance', 'description' => 'We believe people do their best work when they have room to thrive.'],
    ['icon' => 'M12 2 15 8l6.5 1-4.7 4.6 1.1 6.4L12 17l-5.9 3 1.1-6.4L2.5 9 9 8z', 'title' => 'Meaningful Impact', 'description' => 'Contribute to services that help clients and colleagues move forward.'],
];

$careerValues = [
    ['icon' => 'M20 7 10 17l-5-5m7-9 2.2 4.8L20 10l-5.8 2.2L12 18l-2.2-5.8L4 10l5.8-2.2L12 2Z', 'title' => 'Integrity'],
    ['icon' => 'M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m6-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7 1a4 4 0 0 1 3 4v2', 'title' => 'Collaboration'],
    ['icon' => 'M12 3v3m0 12v3m9-9h-3M6 12H3m15.4-6.4-2.1 2.1M7.7 16.3l-2.1 2.1m12.8 0-2.1-2.1M7.7 7.7 5.6 5.6M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z', 'title' => 'Innovation'],
    ['icon' => 'M3 17 9 11l4 4 8-9m-6 0h6v6', 'title' => 'Continuous Improvement'],
    ['icon' => 'm12 3 8 4v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V7l8-4Zm-3 9 2 2 4-4', 'title' => 'Respect & Inclusion'],
    ['icon' => 'M12 2a10 10 0 1 0 10 10M12 2v10l7 4m-2-14v5h5', 'title' => 'Global Mindset'],
];

$talentEmail = 'mailto:info@globaloutsource.com?subject=' . rawurlencode('Careers - CV Submission');

require __DIR__ . '/includes/header.php';
?>

<main id="main-content" class="careers-page">
    <?php require __DIR__ . '/includes/page-banner.php'; ?>

    <section class="careers-hero section-shell" aria-labelledby="careers-hero-title">
        <div class="careers-hero-copy" data-reveal="left">
            <p class="eyebrow"><span class="eyebrow-line"></span>Come grow with us</p>
            <h2 id="careers-hero-title">Be Part of<br><span>Our Journey.</span></h2>
            <p class="careers-hero-lead">Grow your career. Build global solutions.</p>
            <p>At Global Outsource, we believe our people are the key to our success. We offer an inclusive and supportive environment where you can develop your skills, work on global projects and make a real impact for clients in the UK, Ireland and USA.</p>
            <a class="button button-primary" href="#culture">Learn About Our Culture <span class="button-arrow" aria-hidden="true">→</span></a>
        </div>
        <div class="careers-hero-art" aria-label="Illustration representing a connected, collaborative team" role="img" data-reveal="right">
            <div class="careers-art-orbit careers-art-orbit-one"></div>
            <div class="careers-art-orbit careers-art-orbit-two"></div>
            <div class="careers-art-center">
                <span class="careers-art-center-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m6-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7 1a4 4 0 0 1 3 4v2m-2-15a4 4 0 0 1 0 8"/></svg></span>
                <b>People<br><span>make progress.</span></b>
                <small>GROW TOGETHER</small>
            </div>
            <span class="careers-art-node careers-art-node-one"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v18M3 12h18M5.6 5.6l12.8 12.8m0-12.8L5.6 18.4"/></svg></span>
            <span class="careers-art-node careers-art-node-two"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 17 9 11l4 4 8-9m-6 0h6v6"/></svg></span>
            <span class="careers-art-node careers-art-node-three"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2L3 9.6l6.2-.9z"/></svg></span>
            <span class="careers-art-label careers-art-label-one">Curiosity</span>
            <span class="careers-art-label careers-art-label-two">Collaboration</span>
        </div>
    </section>

    <section class="careers-highlights section-shell" aria-label="Career highlights">
        <?php foreach ($careerHighlights as $highlight): ?>
            <article class="careers-highlight" data-reveal="up">
                <span class="careers-highlight-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="<?= htmlspecialchars($highlight['icon'], ENT_QUOTES, 'UTF-8') ?>"/></svg></span>
                <b><?= htmlspecialchars($highlight['title'], ENT_QUOTES, 'UTF-8') ?><br><?= htmlspecialchars($highlight['detail'], ENT_QUOTES, 'UTF-8') ?></b>
            </article>
        <?php endforeach; ?>
    </section>

    <section class="careers-benefits section-shell" aria-labelledby="careers-benefits-title">
        <div class="careers-section-heading" data-reveal="up">
            <p class="eyebrow"><span class="eyebrow-line"></span>Why work with us?</p>
            <h2 id="careers-benefits-title">More Than <span>Just a Job.</span></h2>
            <p>We invest in our people and create opportunities to learn, grow and build a rewarding career with a global perspective.</p>
        </div>
        <div class="careers-benefit-grid">
            <?php foreach ($careerBenefits as $benefit): ?>
                <article class="careers-benefit-card" data-reveal="up">
                    <span class="careers-benefit-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="<?= htmlspecialchars($benefit['icon'], ENT_QUOTES, 'UTF-8') ?>"/></svg></span>
                    <h3><?= htmlspecialchars($benefit['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p><?= htmlspecialchars($benefit['description'], ENT_QUOTES, 'UTF-8') ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="careers-openings" id="open-positions" aria-labelledby="careers-openings-title">
        <div class="careers-openings-inner section-shell<?= $jobsAvailable && $jobs !== [] ? ' careers-openings-inner-listing' : '' ?>">
            <?php if ($jobsAvailable && $jobs !== []): ?>
                <div class="careers-openings-copy careers-openings-copy-wide" data-reveal="up">
                    <p class="eyebrow"><span class="eyebrow-line"></span>Current openings</p>
                    <span class="careers-opening-status is-hiring"><i></i><?= count($jobs) ?> position<?= count($jobs) === 1 ? '' : 's' ?> available</span>
                    <h2 id="careers-openings-title">Find Your Next <span>Opportunity.</span></h2>
                    <p>Explore our current openings and apply directly. We look forward to learning more about you.</p>
                </div>
                <div class="careers-opening-list">
                    <?php foreach ($jobs as $job): ?>
                        <article class="careers-opening-card" data-reveal="up">
                            <div class="careers-opening-card-top">
                                <span class="careers-opening-card-icon" aria-hidden="true">›</span>
                                <span class="careers-opening-meta"><?= backend_escape($job['employment_type']) ?><?= $job['department'] !== '' ? ' · ' . backend_escape($job['department']) : '' ?></span>
                            </div>
                            <h3><?= backend_escape($job['title']) ?></h3>
                            <p class="careers-opening-location"><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg></span> <?= backend_escape($job['location']) ?></p>
                            <p class="careers-opening-summary"><?= backend_escape($job['summary']) ?></p>
                            <?php if ($job['description'] !== ''): ?>
                                <details class="careers-opening-details">
                                    <summary>Role details <span aria-hidden="true">+</span></summary>
                                    <p><?= nl2br(backend_escape($job['description'])) ?></p>
                                    <?php if ($job['requirements'] !== ''): ?>
                                        <b>What we are looking for</b>
                                        <p><?= nl2br(backend_escape($job['requirements'])) ?></p>
                                    <?php endif; ?>
                                </details>
                            <?php endif; ?>
                            <a class="button button-primary careers-apply-link" href="#application-form" data-job-id="<?= (int) $job['id'] ?>">Apply for this role <span class="button-arrow" aria-hidden="true">→</span></a>
                        </article>
                    <?php endforeach; ?>
                </div>

                <dialog class="careers-application-dialog" id="application-form" aria-labelledby="application-dialog-title" data-auto-open="<?= $applicationErrors !== [] ? 'true' : 'false' ?>">
                    <div class="careers-application-panel">
                        <button class="careers-application-close" type="button" data-application-close aria-label="Close application form">×</button>
                        <div class="careers-application-heading">
                            <p class="eyebrow"><span class="eyebrow-line"></span>Take the next step</p>
                            <h2 id="application-dialog-title">Apply for <span data-application-job-title>this role.</span></h2>
                            <p>Your details and CV will be securely reviewed by our hiring team.</p>
                        </div>
                        <?php if ($applicationErrors !== []): ?>
                            <div class="careers-form-feedback careers-form-feedback-error" role="alert">
                                <b>Please check the following:</b>
                                <ul><?php foreach ($applicationErrors as $error): ?><li><?= backend_escape($error) ?></li><?php endforeach; ?></ul>
                            </div>
                        <?php endif; ?>
                        <form class="careers-application-form" action="careers#application-form" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="csrf_token" value="<?= backend_escape(backend_csrf_token()) ?>">
                            <label class="careers-form-trap" aria-hidden="true">Leave this field empty<input type="text" name="fax_number_secondary" tabindex="-1" autocomplete="new-password"></label>
                            <label><span>Full name <i>*</i></span><input type="text" name="name" maxlength="120" autocomplete="name" required value="<?= backend_escape(backend_input_string($applicationInput, 'name')) ?>"></label>
                            <label><span>Email address <i>*</i></span><input type="email" name="email" maxlength="254" autocomplete="email" required value="<?= backend_escape(backend_input_string($applicationInput, 'email')) ?>"></label>
                            <label><span>Phone number</span><input type="tel" name="phone" maxlength="40" autocomplete="tel" value="<?= backend_escape(backend_input_string($applicationInput, 'phone')) ?>"></label>
                            <label><span>Position <i>*</i></span><select name="job_id" required><option value="">Select an opening</option><?php foreach ($jobs as $job): ?><option value="<?= (int) $job['id'] ?>"<?= backend_input_string($applicationInput, 'job_id') === (string) $job['id'] ? ' selected' : '' ?>><?= backend_escape($job['title']) ?></option><?php endforeach; ?></select></label>
                            <label class="careers-application-wide"><span>Short introduction</span><textarea name="cover_letter" rows="4" maxlength="4000" placeholder="Tell us a little about yourself and your experience."><?= backend_escape(backend_input_string($applicationInput, 'cover_letter')) ?></textarea></label>
                            <label class="careers-application-wide"><span>Upload your CV <i>*</i></span><input type="file" name="cv" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required><small>PDF, DOC or DOCX · Maximum file size 5 MB</small></label>
                            <div class="careers-application-wide careers-application-submit"><button class="button button-primary" type="submit">Submit Application <span class="button-arrow" aria-hidden="true">→</span></button></div>
                        </form>
                    </div>
                </dialog>
            <?php else: ?>
                <div class="careers-openings-visual" aria-hidden="true" data-reveal="left">
                    <span class="careers-openings-ring careers-openings-ring-one"></span>
                    <span class="careers-openings-ring careers-openings-ring-two"></span>
                    <span class="careers-openings-icon"><svg viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="14" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m-13 5h18m-11 0v2h4v-2"/></svg></span>
                    <span class="careers-openings-orbit-dot"></span>
                </div>
                <div class="careers-openings-copy" data-reveal="right">
                    <p class="eyebrow"><span class="eyebrow-line"></span>Current openings</p>
                    <span class="careers-opening-status"><i></i><?= $jobsAvailable ? 'Hiring updates' : 'Openings temporarily unavailable' ?></span>
                    <h2 id="careers-openings-title"><?= $jobsAvailable ? 'No Open Positions' : 'We’re Updating Our Openings.' ?> <span><?= $jobsAvailable ? 'at the Moment.' : 'Please Check Back Soon.' ?></span></h2>
                    <p><?= $jobsAvailable ? 'We do not have any open positions right now, but we are always interested in hearing from talented and motivated people who share our values.' : 'Our current vacancies could not be loaded right now. Please check back soon or contact our team for assistance.' ?></p>
                    <p><?= $jobsAvailable ? 'Please check back soon, or contact our team to learn about future opportunities.' : 'We appreciate your interest in joining Global Outsource.' ?></p>
                    <a class="careers-text-link" href="<?= htmlspecialchars($talentEmail, ENT_QUOTES, 'UTF-8') ?>">Introduce yourself to our team <span aria-hidden="true">→</span></a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="careers-values" id="culture" aria-labelledby="careers-values-title">
        <div class="careers-values-inner section-shell">
            <div class="careers-values-copy" data-reveal="left">
                <p class="eyebrow">Our people. Our strength.</p>
                <h2 id="careers-values-title">Our Values Drive<br><span>Our Success.</span></h2>
                <p>We foster a culture built on integrity, collaboration and continuous improvement, enabling our people to achieve their full potential.</p>
            </div>
            <div class="careers-values-grid">
                <?php foreach ($careerValues as $value): ?>
                    <article class="careers-value" data-reveal="up">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="<?= htmlspecialchars($value['icon'], ENT_QUOTES, 'UTF-8') ?>"/></svg>
                        <b><?= htmlspecialchars($value['title'], ENT_QUOTES, 'UTF-8') ?></b>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/submission-modal.php'; ?>
<?php require __DIR__ . '/includes/footer.php'; ?>
