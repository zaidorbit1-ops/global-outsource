<?php
declare(strict_types=1);

$currentPage = 'privacy-policy';
$pageTitle = 'Privacy Policy | Global Outsource';
$pageDescription = 'Learn how Global Outsource collects, uses, stores and protects information submitted through this website.';
$breadcrumbItems = [
    ['label' => 'Home', 'url' => 'index'],
    ['label' => 'Privacy Policy'],
];
$pageBannerTitle = 'Privacy';
$pageBannerAccent = 'Policy';
$pageBannerEyebrow = 'Your information matters';
$pageBannerTagline = 'How we handle information shared with us';
$pageBannerDescription = 'This policy explains the information we receive through this website and how it is used to respond to enquiries and applications.';
require __DIR__ . '/includes/header.php';
?>

<main id="main-content" class="legal-page">
    <?php require __DIR__ . '/includes/page-banner.php'; ?>
    <article class="legal-content section-shell">
        <p class="legal-updated">Last updated <?= date('F Y') ?></p>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Who this policy covers</h2><p>This Privacy Policy applies to information submitted through the Global Outsource website, including contact enquiries and job applications. It describes our website practices; a separate written agreement may govern information handled while delivering client services.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Information you provide</h2><p>Depending on the form you use, we may receive your name, email address, telephone number, service interest and message. Job applications may also include a cover letter, CV and related application details. Please do not submit information that is not needed for your enquiry or application.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>How we use information</h2><p>We use submitted information to respond to enquiries, discuss requested services, assess applications, communicate about recruitment and operate or protect the website. We do not describe an enquiry form submission as consent to unrelated marketing.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Storage and service providers</h2><p>Website submissions are stored in the application database and are available to authorised personnel for their relevant business purpose. The website also uses third-party services such as Google Fonts and an embedded Google Map; when those services load, their providers may receive technical information under their own privacy terms.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Retention and security</h2><p>We retain enquiries and application information for as long as it is reasonably needed to respond, manage the relevant relationship or recruitment process, meet applicable obligations, and handle legitimate business records. We use safeguards intended to protect stored submissions, but no online transmission or storage method can be guaranteed completely secure.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Your choices and requests</h2><p>You may contact us to ask about personal information you submitted, request a correction, or ask us to delete it where we are able to do so. We may need to retain information where required for a current agreement, legitimate business record or applicable legal obligation. Contact <a href="mailto:info@theglobaloutsource.com">info@theglobaloutsource.com</a> with your request.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Updates and contact</h2><p>We may update this policy when website practices change. The latest version will be published on this page with its updated month and year. For privacy questions, contact Global Outsource at <a href="mailto:info@theglobaloutsource.com">info@theglobaloutsource.com</a>.</p></div>
        </section>
    </article>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
