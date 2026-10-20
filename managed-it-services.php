<?php
declare(strict_types=1);

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; script-src 'self'; connect-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'");

$currentPage = 'managed-it-services';
$pageTitle = 'Managed IT Services | Global Outsource';
$pageDescription = 'Reliable and proactive managed IT services to keep your business secure, efficient and running smoothly.';
$breadcrumbItems = [
    ['label' => 'Home', 'url' => 'index'],
    ['label' => 'Services', 'url' => 'index#services'],
    ['label' => 'Managed IT Services'],
];
$pageBannerTitle = 'Managed';
$pageBannerAccent = 'IT Services';
$pageBannerEyebrow = 'Reliable and proactive IT support to keep your business running smoothly.';
$pageBannerTagline = 'Proactive IT support for business success.';
$pageBannerDescription = 'We provide end-to-end managed IT services to businesses in the UK, Ireland and USA, helping them maintain secure, efficient and high-performing IT environments so they can focus on growth.';
$managedItImage = 'assets/services/managed-it-services.png';

require __DIR__ . '/includes/header.php';
?>

<main id="main-content" class="service-page managed-it-page">
    <?php require __DIR__ . '/includes/page-banner.php'; ?>

    <?php require __DIR__ . '/includes/service-switcher.php'; ?>

    <section class="accounting-intro section-shell" aria-labelledby="managed-it-intro-title">
        <div class="accounting-intro-copy" data-reveal="left">
            <p class="eyebrow"><span class="eyebrow-line"></span>Managed IT Services</p>
            <h2 id="managed-it-intro-title">Proactive IT Support for <span>Business Success</span></h2>
            <p>Our managed IT services are designed to keep your systems secure, reliable and up to date. We act as an extension of your IT team, providing proactive support, monitoring and maintenance to minimise downtime and ensure your business operates efficiently.</p>
            <a class="button button-primary" href="contact">Get a Free Consultation <span class="button-arrow" aria-hidden="true">→</span></a>
        </div>
        <div class="accounting-intro-image" data-reveal="right">
            <?php if (is_file(__DIR__ . '/' . $managedItImage)): ?>
                <img src="<?= htmlspecialchars($managedItImage, ENT_QUOTES, 'UTF-8') ?>" alt="IT operations team monitoring business systems and providing managed support" width="1000" height="700">
            <?php else: ?>
                <div class="accounting-image-placeholder" role="img" aria-label="Add the managed IT services image at assets/services/managed-it-services.png">
                    <span class="accounting-image-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="13" rx="2"/><path d="M8 21h8m-4-4v4m-5-9 2 2 4-4"/></svg></span>
                    <b>Managed IT Services</b>
                    <small>Service image · 1000 × 700 px</small>
                </div>
            <?php endif; ?>
        </div>
        <ul class="accounting-benefit-list" data-reveal="right" aria-label="Benefits of managed IT services">
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span><span><b>Minimise Downtime</b><small>Proactive monitoring and quick issue resolution.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 3 4 7v5c0 5 3.4 8 8 9 4.6-1 8-4 8-9V7zm-3 9 2 2 4-4"/></svg></span><span><b>Keep Systems Secure</b><small>Continuous security updates and threat protection.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5"/></svg></span><span><b>Improve Efficiency</b><small>Reliable IT infrastructure for smooth operations.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span><span><b>Expert Support</b><small>Access to an experienced and responsive IT team.</small></span></li>
        </ul>
    </section>

    <section class="accounting-services section-shell" aria-labelledby="key-managed-it-services">
        <div class="accounting-section-heading" data-reveal="up">
            <p class="eyebrow"><span class="eyebrow-line"></span>Reliable support, day in and day out</p>
            <h2 id="key-managed-it-services">Key Managed IT Services</h2>
            <p>Proactive IT care to protect your systems and help your business run smoothly.</p>
        </div>
        <div class="accounting-service-grid">
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="13" rx="2"/><path d="M8 21h8m-4-4v4m-5-9 2 2 4-4"/></svg></span>
                <h3>24/7 IT Support</h3>
                <p>Remote and on-site support to resolve issues quickly and keep your business running smoothly.</p>
                <a href="contact" aria-label="Ask us about 24/7 IT support">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7 18a4 4 0 1 1 .8-7.9A5.5 5.5 0 0 1 18 9a4.5 4.5 0 1 1 0 9Z"/><path d="M12 12v8m-3-3 3 3 3-3"/></svg></span>
                <h3>Cloud Management</h3>
                <p>Setup, management and ongoing support for Microsoft 365, AWS, Google Cloud and other cloud platforms.</p>
                <a href="contact" aria-label="Ask us about cloud management">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span>
                <h3>Cybersecurity Management</h3>
                <p>Threat monitoring, antivirus, firewall management and security best practices.</p>
                <a href="contact" aria-label="Ask us about cybersecurity management">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="15" rx="2"/><path d="M7 8h10M7 12h10M7 16h4M8 22h8"/></svg></span>
                <h3>Network &amp; Infrastructure</h3>
                <p>Design, setup, monitoring and maintenance of your IT network and infrastructure.</p>
                <a href="contact" aria-label="Ask us about network and infrastructure support">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2M5 4 3 2m16 2 2-2"/></svg></span>
                <h3>System Monitoring &amp; Updates</h3>
                <p>Continuous monitoring, patch management and regular system updates.</p>
                <a href="contact" aria-label="Ask us about system monitoring and updates">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span>
                <h3>IT Consultancy</h3>
                <p>Strategic advice to improve your IT systems, reduce costs and support business growth.</p>
                <a href="contact" aria-label="Ask us about IT consultancy">↗</a>
            </article>
        </div>
    </section>

    <section class="finance-value-band" aria-labelledby="managed-it-value-title">
        <div class="finance-value-inner section-shell" data-reveal="up">
            <div class="finance-value-copy">
                <p class="eyebrow"><span class="eyebrow-line"></span>Why choose our managed IT services</p>
                <h2 id="managed-it-value-title">A Reliable IT Partner for <span>Long-Term Growth</span></h2>
                <p>We provide a proactive and client-focused approach to managed IT services, helping businesses stay secure, efficient and prepared for the future.</p>
                <a class="button button-primary" href="contact">Talk to Our Team <span class="button-arrow" aria-hidden="true">→</span></a>
            </div>
            <div class="finance-value-points it-value-points">
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span><b>Experienced<br>IT Professionals</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span><b>Proactive<br>Monitoring</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v14c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 10c0 1.7 3.6 3 8 3s8-1.3 8-3"/></svg></span><b>Cost-Effective<br>Solutions</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 3 4 7v5c0 5 3.4 8 8 9 4.6-1 8-4 8-9V7zm-3 9 2 2 4-4"/></svg></span><b>Secure &amp; Compliant<br>IT Environments</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5"/></svg></span><b>Scalable for<br>Your Business</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 13v-2a8 8 0 0 1 16 0v2"/><path d="M4 13H2v5h4v-5zm16 0h2v5h-4v-5zM6 18a6 6 0 0 0 6 4h2"/></svg></span><b>Fast &amp; Responsive<br>Support</b></article>
            </div>
        </div>
    </section>

        <?php require __DIR__ . '/includes/process-section.php'; ?>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
