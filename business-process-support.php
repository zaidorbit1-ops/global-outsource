<?php
declare(strict_types=1);

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; script-src 'self'; connect-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'");

$currentPage = 'business-process-support';
$pageTitle = 'Business Process Support Services | Global Outsource';
$pageDescription = 'Streamlined business process support to help your business run efficiently, reduce costs and focus on growth.';
$breadcrumbItems = [
    ['label' => 'Home', 'url' => 'index'],
    ['label' => 'Services', 'url' => 'index#services'],
    ['label' => 'Business Process Support'],
];
$pageBannerTitle = 'Business Process';
$pageBannerAccent = 'Support';
$pageBannerEyebrow = 'Streamlined processes to help your business run more efficiently.';
$pageBannerTagline = 'People. Process. Sustainable Growth.';
$pageBannerDescription = 'We provide comprehensive business process support services to help businesses in the UK, Ireland and USA reduce costs, improve efficiency and focus on their core growth activities.';
$businessProcessImage = 'assets/services/business-process-support.png';
require __DIR__ . '/includes/header.php';
?>

<main id="main-content" class="service-page business-process-page">
    <?php require __DIR__ . '/includes/page-banner.php'; ?>

    <?php require __DIR__ . '/includes/service-switcher.php'; ?>

    <section class="accounting-intro section-shell" aria-labelledby="business-process-intro-title">
        <div class="accounting-intro-copy" data-reveal="left">
            <p class="eyebrow"><span class="eyebrow-line"></span>Our Business Process Support</p>
            <h2 id="business-process-intro-title">Efficient Processes for <span>Sustainable Growth</span></h2>
            <p>We help businesses optimise their day-to-day operations through reliable and cost-effective business process support services. Our team combines people, technology and best practices to deliver streamlined, efficient and scalable processes tailored to your business needs.</p>
            <a class="button button-primary" href="contact">Get a Free Consultation <span class="button-arrow" aria-hidden="true">→</span></a>
        </div>
        <div class="accounting-intro-image" data-reveal="right">
            <?php if (is_file(__DIR__ . '/' . $businessProcessImage)): ?>
                <img src="<?= htmlspecialchars($businessProcessImage, ENT_QUOTES, 'UTF-8') ?>" alt="Business professionals collaborating on efficient digital workflows and operational processes" width="1000" height="700">
            <?php else: ?>
                <div class="accounting-image-placeholder" role="img" aria-label="Add the business process support image at assets/services/business-process-support.png">
                    <span class="accounting-image-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><path d="M6.5 10v4h11v-3"/></svg></span>
                    <b>Business Process Support</b>
                    <small>Service image · 1000 × 700 px</small>
                </div>
            <?php endif; ?>
        </div>
        <ul class="accounting-benefit-list" data-reveal="right" aria-label="Benefits of business process support">
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-1.7 2.9-.2-.1a1.7 1.7 0 0 0-1.8.2l-.2.1h-3.4l-.1-.2a1.7 1.7 0 0 0-1.8-.2l-.2.1-1.7-2.9.1-.1a1.7 1.7 0 0 0 .3-1.9l-.1-.2v-3.4"/></svg></span><span><b>Process Efficiency</b><small>Streamlined and standardised workflows.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v14c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 10c0 1.7 3.6 3 8 3s8-1.3 8-3m-16 5c0 1.7 3.6 3 8 3s8-1.3 8-3"/></svg></span><span><b>Cost Reduction</b><small>Lower operational costs without compromising quality.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span><span><b>Accuracy &amp; Compliance</b><small>Reduce errors and ensure regulatory compliance.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5"/></svg></span><span><b>Scalable Support</b><small>Flexible solutions to grow with your business.</small></span></li>
        </ul>
    </section>

    <section class="accounting-services section-shell" aria-labelledby="key-business-process-services">
        <div class="accounting-section-heading" data-reveal="up">
            <p class="eyebrow"><span class="eyebrow-line"></span>Reliable support for your operations</p>
            <h2 id="key-business-process-services">Key Business Process Support Services</h2>
            <p>Dependable people and practical processes for the work that keeps your business moving.</p>
        </div>
        <div class="accounting-service-grid">
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6 3h9l4 4v14H6z"/><path d="M14 3v5h5M9 13h7m-7 4h7"/></svg></span>
                <h3>Data Processing &amp; Administration</h3>
                <p>Accurate and timely processing of business data, records and administrative tasks.</p>
                <a href="contact" aria-label="Ask us about data processing and administration">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 13v-2a8 8 0 0 1 16 0v2"/><path d="M4 13H2v5h4v-5zm16 0h2v5h-4v-5zM6 18a6 6 0 0 0 6 4h2"/></svg></span>
                <h3>Customer Support Services</h3>
                <p>Professional customer support via email, chat and phone to enhance client satisfaction.</p>
                <a href="contact" aria-label="Ask us about customer support services">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6 3h9l4 4v14H6z"/><path d="M14 3v5h5M9 13h7m-7 4h4"/></svg></span>
                <h3>Document Management</h3>
                <p>Digital document handling, filing, indexing and workflow automation.</p>
                <a href="contact" aria-label="Ask us about document management">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span>
                <h3>Back Office Support</h3>
                <p>End-to-end back office operations including HR administration, procurement and coordination.</p>
                <a href="contact" aria-label="Ask us about back office support">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-1.7 2.9-.2-.1a1.7 1.7 0 0 0-1.8.2l-.2.1h-3.4l-.1-.2a1.7 1.7 0 0 0-1.8-.2l-.2.1-1.7-2.9.1-.1a1.7 1.7 0 0 0 .3-1.9l-.1-.2v-3.4"/></svg></span>
                <h3>Process Automation</h3>
                <p>Implementing tools and automation to improve efficiency and reduce manual work.</p>
                <a href="contact" aria-label="Ask us about process automation">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5M4 4h8v5H4z"/></svg></span>
                <h3>Reporting &amp; MIS Support</h3>
                <p>Management reports, KPI tracking and customised reports to support better decision-making.</p>
                <a href="contact" aria-label="Ask us about reporting and MIS support">↗</a>
            </article>
        </div>
    </section>

    <section class="finance-value-band" aria-labelledby="business-process-value-title">
        <div class="finance-value-inner section-shell" data-reveal="up">
            <div class="finance-value-copy">
                <p class="eyebrow"><span class="eyebrow-line"></span>Why choose our business process support</p>
                <h2 id="business-process-value-title">A Reliable Partner for <span>Operational Excellence</span></h2>
                <p>We combine experienced professionals, proven processes and modern technology to deliver business process support that drives efficiency, reduces costs and helps you focus on what matters most.</p>
                <a class="button button-primary" href="contact">Talk to Our Team <span class="button-arrow" aria-hidden="true">→</span></a>
            </div>
            <div class="finance-value-points it-value-points">
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span><b>Experienced<br>Professionals</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-1.7 2.9-.2-.1a1.7 1.7 0 0 0-1.8.2l-.2.1h-3.4"/></svg></span><b>Proven<br>Processes</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v14c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 10c0 1.7 3.6 3 8 3s8-1.3 8-3"/></svg></span><b>Cost-Effective<br>Solutions</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5"/></svg></span><b>Scalable &amp; Flexible<br>Support</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7 18a4 4 0 1 1 .8-7.9A5.5 5.5 0 0 1 18 9a4.5 4.5 0 1 1 0 9Z"/><path d="M12 12v8"/></svg></span><b>Technology<br>Driven</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/><path d="M12 2v3m10 7h-3M12 22v-3M2 12h3"/></svg></span><b>Focus on<br>Your Core Business</b></article>
            </div>
        </div>
    </section>

        <?php require __DIR__ . '/includes/process-section.php'; ?>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
