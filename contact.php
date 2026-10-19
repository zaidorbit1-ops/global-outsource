<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/backend.php';

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; script-src 'self'; connect-src 'self'; frame-src https://www.google.com https://maps.google.com; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'");

backend_session_start();
$contactInput = [];
$contactErrors = [];
$contactFeedback = null;

if (isset($_SESSION['contact_feedback'])) {
    $contactFeedback = $_SESSION['contact_feedback'];
    unset($_SESSION['contact_feedback']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    backend_verify_csrf();
    $contactInput = $_POST;
    $contactName = trim(backend_input_string($_POST, 'name'));
    $contactAddress = trim(backend_input_string($_POST, 'email'));
    $contactPhone = trim(backend_input_string($_POST, 'phone'));
    $contactService = trim(backend_input_string($_POST, 'service'));
    $contactMessage = trim(backend_input_string($_POST, 'message'));

    if (backend_input_string($_POST, 'fax_number_secondary') !== '') {
        $contactErrors[] = 'Your message could not be submitted. Please try again.';
    }
    if ($contactName === '' || backend_length($contactName) > 120) {
        $contactErrors[] = 'Enter your name (up to 120 characters).';
    }
    if (filter_var($contactAddress, FILTER_VALIDATE_EMAIL) === false || backend_length($contactAddress) > 254) {
        $contactErrors[] = 'Enter a valid email address.';
    }
    if (backend_length($contactPhone) > 40) {
        $contactErrors[] = 'Phone number must be 40 characters or fewer.';
    }
    if (backend_length($contactService) > 100) {
        $contactErrors[] = 'Please select a valid service.';
    }
    if ($contactService !== '' && !in_array($contactService, ['Accountancy & Finance', 'IT Solutions', 'AI Solutions', 'Software Development', 'Managed IT Services', 'Cloud Solutions', 'Business Process Support', 'Careers', 'Other Enquiry'], true)) {
        $contactErrors[] = 'Please select a valid service.';
    }
    if (backend_length($contactMessage) > 4000) {
        $contactErrors[] = 'Keep your message within 4,000 characters.';
    }

    if ($contactErrors === []) {
        if (!database_is_configured()) {
            $contactErrors[] = 'The message form is temporarily unavailable. Please email info@globaloutsource.com.';
        } else {
            try {
                $database = app_database();
                backend_record_public_submission($database, 'contact');
                $statement = $database->prepare('INSERT INTO contact_messages (name, email, phone, service, message) VALUES (:name, :email, :phone, :service, :message)');
                $statement->execute([
                    'name' => $contactName,
                    'email' => $contactAddress,
                    'phone' => $contactPhone,
                    'service' => $contactService,
                    'message' => $contactMessage,
                ]);

                $successMessage = 'Thank you, ' . $contactName . '. We have received your enquiry, and our team will get back to you.';
                if (backend_is_ajax_request()) {
                    backend_json_response(['success' => true, 'title' => 'Message received', 'message' => $successMessage]);
                }

                $_SESSION['contact_feedback'] = ['type' => 'success', 'message' => $successMessage];
                backend_redirect('contact?sent=1#contact-form');
            } catch (RuntimeException $exception) {
                if (str_starts_with($exception->getMessage(), 'Too many submissions.')) {
                    $contactErrors[] = $exception->getMessage();
                } else {
                    error_log('Contact form could not save a message: ' . $exception->getMessage());
                    $contactErrors[] = 'We could not save your message right now. Please try again later or email info@globaloutsource.com.';
                }
            } catch (Throwable $exception) {
                error_log('Contact form could not save a message: ' . $exception->getMessage());
                $contactErrors[] = 'We could not save your message right now. Please try again later or email info@globaloutsource.com.';
            }
        }

    }

    if (backend_is_ajax_request() && $contactErrors !== []) {
        backend_json_response(['success' => false, 'title' => 'Please check your message', 'errors' => $contactErrors, 'message' => implode(' ', $contactErrors)], 422);
    }
}

$currentPage = 'contact';
$pageTitle = 'Contact Us | Global Outsource';
$pageDescription = 'Contact Global Outsource for accountancy, IT, AI and business support. Our team in Karachi supports clients across the UK, Ireland and USA.';
$breadcrumbItems = [
    ['label' => 'Home', 'url' => 'index'],
    ['label' => 'Contact Us'],
];
$pageBannerTitle = 'Contact';
$pageBannerAccent = 'Us';
$pageBannerEyebrow = 'We are here to help';
$pageBannerTagline = 'Let’s Start a Conversation';
$pageBannerDescription = 'Whether you have a question, need support, or want to discuss how we can work together, our team is ready to hear from you.';
$hideFooterCta = true;

$contactDetails = [
    [
        'icon' => 'M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7l.5 3.1a2 2 0 0 1-.6 1.7L7.1 10.4a16 16 0 0 0 6 6l1.9-1.9a2 2 0 0 1 1.7-.6l3.1.5a2 2 0 0 1 2.2 2.5Z',
        'title' => 'Phone',
        'primary' => '+92 300 1234567',
        'secondary' => 'Mon - Fri: 9:00 AM - 6:00 PM (PKT)',
        'href' => 'tel:+923001234567',
    ],
    [
        'icon' => 'M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Zm18 2-10 8L2 6',
        'title' => 'Email',
        'primary' => 'info@globaloutsource.com',
        'secondary' => 'We typically respond within one business day.',
        'href' => 'mailto:info@globaloutsource.com',
    ],
    [
        'icon' => 'M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Zm-5 0a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z',
        'title' => 'Office Address',
        'primary' => 'Karachi, Pakistan',
        'secondary' => 'Our team is based in Karachi and supports clients worldwide.',
        'href' => '#karachi-map',
    ],
    [
        'icon' => 'M12 8v4l3 2m6-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
        'title' => 'Business Hours',
        'primary' => 'Mon - Fri: 9:00 AM - 6:00 PM',
        'secondary' => 'Pakistan Standard Time (PKT). Saturday - Sunday: Closed.',
        'href' => null,
    ],
];
require __DIR__ . '/includes/header.php';
?>

<main id="main-content" class="contact-page">
    <?php require __DIR__ . '/includes/page-banner.php'; ?>

    <section class="contact-hero section-shell" aria-label="Contact Global Outsource">
        <div class="contact-hero-copy" data-reveal="left">
            <p class="eyebrow"><span class="eyebrow-line"></span>People. Solutions. Technology. Growth.</p>
            <h2>Let’s Start<br>a <span>Conversation.</span></h2>
            <p>Tell us what you are looking for. Whether it is a question, a new project or support for your business, our team is ready to help.</p>
            <a class="button button-primary" href="#contact-form">Send Us a Message <span class="button-arrow" aria-hidden="true">→</span></a>
        </div>
        <div class="contact-hero-visual" role="img" aria-label="Illustration of a welcoming professional office" data-reveal="right">
            <div class="contact-office-window"><span></span><span></span><span></span></div>
            <div class="contact-office-plant contact-office-plant-one"><i></i><i></i><i></i><b></b></div>
            <div class="contact-office-plant contact-office-plant-two"><i></i><i></i><i></i><b></b></div>
            <div class="contact-office-sign"><span class="contact-sign-mark">G</span><span><b>Global <em>Outsource</em></b><small>PEOPLE. TECHNOLOGY. OPPORTUNITY.</small></span></div>
            <div class="contact-office-desk"><span></span></div>
            <div class="contact-office-caption"><span class="contact-office-live"></span> Karachi, Pakistan <i></i> Connected worldwide</div>
            <span class="contact-hero-orbit contact-hero-orbit-one"></span>
            <span class="contact-hero-orbit contact-hero-orbit-two"></span>
        </div>
    </section>

    <section class="contact-info-grid section-shell" aria-label="Contact information">
        <?php foreach ($contactDetails as $detail): ?>
            <article class="contact-info-card" data-reveal="up">
                <span class="contact-info-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="<?= htmlspecialchars($detail['icon'], ENT_QUOTES, 'UTF-8') ?>"/></svg></span>
                <div class="contact-info-copy">
                    <h2><?= htmlspecialchars($detail['title'], ENT_QUOTES, 'UTF-8') ?></h2>
                    <?php if ($detail['href'] !== null): ?>
                        <a href="<?= htmlspecialchars($detail['href'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($detail['primary'], ENT_QUOTES, 'UTF-8') ?></a>
                    <?php else: ?>
                        <b><?= htmlspecialchars($detail['primary'], ENT_QUOTES, 'UTF-8') ?></b>
                    <?php endif; ?>
                    <p><?= htmlspecialchars($detail['secondary'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
            </article>
        <?php endforeach; ?>
    </section>

    <section class="contact-message-section section-shell" aria-label="Send us a message">
        <div class="contact-location-panel" data-reveal="left">
            <div class="contact-map-art" id="karachi-map">
                <iframe
                    title="Google Maps showing Karachi, Pakistan"
                    src="https://www.google.com/maps/embed?origin=mfe&amp;pb=!1m2!2m1!1sKarachi,+Pakistan!3m1!1sen!5m1!1sen"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    allowfullscreen>
                </iframe>
            </div>
            <div class="contact-location-note">
                <span class="contact-location-note-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s-8-4.5-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 6.5-8 11-8 11Z"/></svg></span>
                <span><b>Based in Karachi. Connected worldwide.</b><small>Serving clients across the UK, Ireland and USA.</small></span>
            </div>
        </div>

        <div class="contact-form-panel" id="contact-form" data-reveal="right">
            <div class="contact-form-heading">
                <p class="eyebrow"><span class="eyebrow-line"></span>We’d love to hear from you</p>
                <h2>Send Us a <span>Message.</span></h2>
                <p>Share a few details and our team will get back to you.</p>
            </div>
            <?php if (is_array($contactFeedback)): ?>
                <p class="contact-form-feedback contact-form-feedback-success" role="status"><?= backend_escape($contactFeedback['message'] ?? '') ?></p>
            <?php endif; ?>
            <?php if ($contactErrors !== []): ?>
                <div class="contact-form-feedback contact-form-feedback-error" role="alert">
                    <b>Please check the following:</b>
                    <ul><?php foreach ($contactErrors as $error): ?><li><?= backend_escape($error) ?></li><?php endforeach; ?></ul>
                </div>
            <?php endif; ?>
            <form class="contact-form" action="contact#contact-form" method="post">
                <input type="hidden" name="csrf_token" value="<?= backend_escape(backend_csrf_token()) ?>">
                <label class="contact-form-trap" aria-hidden="true">Leave this field empty<input type="text" name="fax_number_secondary" tabindex="-1" autocomplete="new-password"></label>
                <div class="contact-form-fields">
                    <label class="contact-field">
                        <span>Your Name <i>*</i></span>
                        <input type="text" name="name" autocomplete="name" maxlength="120" placeholder="e.g. Alex Morgan" required value="<?= backend_escape(backend_input_string($contactInput, 'name')) ?>">
                    </label>
                    <label class="contact-field">
                        <span>Your Email <i>*</i></span>
                        <input type="email" name="email" autocomplete="email" maxlength="254" placeholder="you@company.com" required value="<?= backend_escape(backend_input_string($contactInput, 'email')) ?>">
                    </label>
                    <label class="contact-field">
                        <span>Phone Number</span>
                        <input type="tel" name="phone" autocomplete="tel" maxlength="40" placeholder="+1 555 123 4567" value="<?= backend_escape(backend_input_string($contactInput, 'phone')) ?>">
                    </label>
                    <label class="contact-field">
                        <span>Service of Interest</span>
                        <select name="service">
                            <option value="">Select a service</option>
                            <?php foreach (['Accountancy & Finance', 'IT Solutions', 'AI Solutions', 'Software Development', 'Managed IT Services', 'Cloud Solutions', 'Business Process Support', 'Careers', 'Other Enquiry'] as $service): ?>
                                <option value="<?= backend_escape($service) ?>"<?= backend_input_string($contactInput, 'service') === $service ? ' selected' : '' ?>><?= backend_escape($service) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label class="contact-field contact-field-message">
                        <span>Your Message <small>(Optional)</small></span>
                        <textarea name="message" rows="5" maxlength="4000" placeholder="How can we help?"><?= backend_escape(backend_input_string($contactInput, 'message')) ?></textarea>
                    </label>
                </div>
                <p class="contact-form-note">Your message will be stored securely and reviewed by our team.</p>
                <button class="button button-primary contact-submit" type="submit">Send Message <span class="button-arrow" aria-hidden="true">→</span></button>
            </form>
        </div>
    </section>

    <section class="contact-visit section-shell" aria-labelledby="contact-visit-title">
        <div class="contact-visit-visual" role="img" aria-label="Abstract illustration of a comfortable professional meeting space" data-reveal="left">
            <div class="contact-meeting-window"><span></span><span></span><span></span></div>
            <div class="contact-meeting-plant"><i></i><i></i><i></i><b></b></div>
            <div class="contact-meeting-table"><span></span></div>
            <div class="contact-meeting-chair contact-meeting-chair-one"></div>
            <div class="contact-meeting-chair contact-meeting-chair-two"></div>
            <span class="contact-meeting-glow"></span>
        </div>
        <div class="contact-visit-copy" data-reveal="right">
            <p class="eyebrow"><span class="eyebrow-line"></span>Visit our office</p>
            <h2 id="contact-visit-title">We’d Love to <span>Meet You.</span></h2>
            <p>Our office in Karachi is accessible and our team is always happy to welcome clients, partners and professionals. Please get in touch to arrange a meeting.</p>
            <div class="contact-visit-features">
                <div><span><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 13h18l-2 7H5l-2-7Zm3 0 2-6h8l2 6m-11 7v2m10-2v2M6 17h.01M18 17h.01"/></svg></span><b>Convenient<br>Location</b></div>
                <div><span><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m6-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7 1a4 4 0 0 1 3 4v2"/></svg></span><b>Professional<br>Team</b></div>
                <div><span><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 10h18M5 10v9m4-9v9m6-9v9m4-9v9M3 21h18M12 3l9 5H3l9-5Z"/></svg></span><b>Meeting<br>Facilities</b></div>
            </div>
        </div>
    </section>

    <section class="contact-quick-help" aria-labelledby="contact-quick-title">
        <div class="contact-quick-inner section-shell">
            <div class="contact-quick-copy" data-reveal="left">
                <p class="eyebrow">Need a quick answer?</p>
                <h2 id="contact-quick-title">Let’s find the <span>right next step.</span></h2>
                <p>Tell us what you need help with. We’ll connect you with the right person on our team.</p>
                <a class="button button-secondary contact-quick-button" href="mailto:info@globaloutsource.com">Email Our Team <span class="button-arrow" aria-hidden="true">→</span></a>
            </div>
            <div class="contact-quick-cards" aria-hidden="true">
                <span><svg viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7l.5 3.1a2 2 0 0 1-.6 1.7L7.1 10.4a16 16 0 0 0 6 6l1.9-1.9a2 2 0 0 1 1.7-.6l3.1.5a2 2 0 0 1 2.2 2.5Z"/></svg></span>
                <span><svg viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Zm18 2-10 8L2 6"/></svg></span>
                <span><svg viewBox="0 0 24 24"><path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Zm-5 0a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg></span>
                <i></i><i></i><i></i>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/submission-modal.php'; ?>
<?php require __DIR__ . '/includes/footer.php'; ?>
