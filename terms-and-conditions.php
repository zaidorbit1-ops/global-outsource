<?php
declare(strict_types=1);

$currentPage = 'terms-and-conditions';
$pageTitle = 'Terms and Conditions | Global Outsource';
$pageDescription = 'Read the terms that apply to use of the Global Outsource website.';
$breadcrumbItems = [
    ['label' => 'Home', 'url' => 'index'],
    ['label' => 'Terms and Conditions'],
];
$pageBannerTitle = 'Terms &';
$pageBannerAccent = 'Conditions';
$pageBannerEyebrow = 'Website terms';
$pageBannerTagline = 'Using the Global Outsource website';
$pageBannerDescription = 'These terms explain the basic conditions for accessing and using this website.';
require __DIR__ . '/includes/header.php';
?>

<main id="main-content" class="legal-page">
    <?php require __DIR__ . '/includes/page-banner.php'; ?>
    <article class="legal-content section-shell">
        <p class="legal-updated">Last updated <?= date('F Y') ?></p>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Acceptance of these terms</h2><p>By accessing or using this website, you agree to these Terms and Conditions. If you do not agree, please stop using the website. These terms apply to website use and do not replace a separate signed agreement for services.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Website information</h2><p>The website provides general information about Global Outsource, its capabilities and services. Website content is not a binding offer, professional advice, or a guarantee that a particular service is available or suitable for a specific requirement. Confirm scope and availability with our team.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Service engagements</h2><p>Any service engagement is subject to written confirmation and the applicable signed proposal, statement of work or service agreement. That agreement governs the service scope, fees, delivery arrangements, responsibilities, changes and other engagement terms. If it conflicts with these website terms, the signed service agreement governs the engagement.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Acceptable use</h2><p>You may use this website only for lawful purposes. Do not attempt to disrupt, damage, gain unauthorised access to, or interfere with the website, its systems, forms or other users. Do not submit false, unlawful, harmful or infringing material through a website form.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Content and intellectual property</h2><p>Unless stated otherwise, website text, branding, design and other materials belong to Global Outsource or are used with permission. You may view the website for personal or internal business evaluation; copying, republishing or commercially exploiting website materials requires prior written permission. Rights in client deliverables are governed by the relevant signed agreement.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Availability and external services</h2><p>We may update, suspend or remove website content and cannot promise uninterrupted availability. The website may link to or embed third-party services, including Google Maps; those services are provided under their own terms and policies, and we do not control their operation.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Liability and questions</h2><p>To the extent permitted by applicable law, website materials are provided for general information without a guarantee that they will be complete, current or error-free. Nothing in these terms excludes liability that cannot lawfully be excluded. For questions about these terms or our services, contact <a href="mailto:info@theglobaloutsource.com">info@theglobaloutsource.com</a>.</p></div>
        </section>
    </article>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
