<?php
declare(strict_types=1);

$currentPage = 'refund-policy';
$pageTitle = 'Refund Policy | Global Outsource';
$pageDescription = 'Understand how cancellation and refund requests are handled under Global Outsource signed service agreements.';
$breadcrumbItems = [
    ['label' => 'Home', 'url' => 'index'],
    ['label' => 'Refund Policy'],
];
$pageBannerTitle = 'Refund';
$pageBannerAccent = 'Policy';
$pageBannerEyebrow = 'Engagement terms';
$pageBannerTagline = 'Clear handling of cancellation and refund requests';
$pageBannerDescription = 'Refund and cancellation requests are reviewed case-by-case under the signed service agreement for the relevant engagement.';
require __DIR__ . '/includes/header.php';
?>

<main id="main-content" class="legal-page">
    <?php require __DIR__ . '/includes/page-banner.php'; ?>
    <article class="legal-content section-shell">
        <p class="legal-updated">Last updated <?= date('F Y') ?></p>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Scope of this policy</h2><p>This policy explains how Global Outsource reviews cancellation and refund requests for services. It applies together with the proposal, statement of work or service agreement signed for the specific engagement.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>The signed agreement governs</h2><p>Refund eligibility, cancellation rights, payment milestones, notice requirements and any applicable fees are determined by the signed service agreement. If that agreement contains specific terms, those terms take precedence over this general policy.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>How requests are reviewed</h2><p>Each request is considered case-by-case in light of the signed agreement and the circumstances of the engagement. A request does not automatically qualify for a refund, and this policy does not promise a particular outcome.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Submit a written request</h2><p>Send your request to <a href="mailto:info@globaloutsource.com">info@globaloutsource.com</a>. Include your organisation name, the relevant service or project, invoice or agreement reference, the requested cancellation or refund, and a short explanation. Please use an authorised contact for the engagement.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Work performed and outstanding amounts</h2><p>During review, any payment obligations, completed work, committed resources, milestones and cancellation charges will be considered as described in the signed agreement. Please continue to follow the agreement unless Global Outsource confirms a change in writing.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Review and written outcome</h2><p>Our team may contact you to clarify details or request relevant supporting documents. We will communicate the outcome and any agreed next steps in writing. Processing arrangements, if a refund is approved, will be confirmed as part of that written response.</p></div>
        </section>
        <section class="legal-section">
            <span class="legal-section-marker" aria-hidden="true"></span>
            <div><h2>Questions and applicable rights</h2><p>For questions about a payment, cancellation or refund, contact <a href="mailto:info@globaloutsource.com">info@globaloutsource.com</a>. This policy does not limit any rights that cannot be excluded under applicable law; your signed agreement and applicable legal requirements remain relevant.</p></div>
        </section>
    </article>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
