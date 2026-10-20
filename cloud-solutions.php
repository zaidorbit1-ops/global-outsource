<?php
declare(strict_types=1);

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; script-src 'self'; connect-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'");

$currentPage = 'cloud-solutions';
$pageTitle = 'Cloud Solutions & Services | Global Outsource';
$pageDescription = 'Secure, flexible and scalable cloud solutions for businesses in the UK, Ireland and USA, including migration, management and optimisation.';
$breadcrumbItems = [
    ['label' => 'Home', 'url' => 'index'],
    ['label' => 'Services', 'url' => 'index#services'],
    ['label' => 'Cloud Solutions'],
];
$pageBannerTitle = 'Cloud';
$pageBannerAccent = 'Solutions';
$pageBannerEyebrow = 'Secure, flexible and scalable cloud solutions for modern businesses.';
$pageBannerTagline = 'Enable a more flexible, secure and efficient future.';
$pageBannerDescription = 'We help businesses in the UK, Ireland and USA migrate, manage and optimise their cloud environments, enabling them to work more efficiently, reduce costs and stay secure with industry best practices.';
$cloudSolutionsImage = 'assets/services/cloud-solutions.png';

require __DIR__ . '/includes/header.php';
?>

<main id="main-content" class="service-page cloud-solutions-page">
    <?php require __DIR__ . '/includes/page-banner.php'; ?>

    <?php require __DIR__ . '/includes/service-switcher.php'; ?>

    <section class="accounting-intro section-shell" aria-labelledby="cloud-intro-title">
        <div class="accounting-intro-copy" data-reveal="left">
            <p class="eyebrow"><span class="eyebrow-line"></span>Our Cloud Solutions</p>
            <h2 id="cloud-intro-title">Enable a More Flexible, Secure and <span>Efficient Future</span></h2>
            <p>We design, implement and manage cloud solutions that help businesses improve performance, enhance collaboration and reduce IT costs. Our team works with leading cloud platforms to deliver reliable, secure and scalable environments tailored to your business needs.</p>
            <a class="button button-primary" href="contact">Get a Free Consultation <span class="button-arrow" aria-hidden="true">→</span></a>
        </div>
        <div class="accounting-intro-image" data-reveal="right">
            <?php if (is_file(__DIR__ . '/' . $cloudSolutionsImage)): ?>
                <img src="<?= htmlspecialchars($cloudSolutionsImage, ENT_QUOTES, 'UTF-8') ?>" alt="Cloud infrastructure and connected devices managed in a secure cloud environment" width="1000" height="700">
            <?php else: ?>
                <div class="accounting-image-placeholder" role="img" aria-label="Add the cloud solutions image at assets/services/cloud-solutions.png">
                    <span class="accounting-image-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7 18a4 4 0 1 1 .8-7.9A5.5 5.5 0 0 1 18 9a4.5 4.5 0 1 1 0 9Z"/><path d="M12 12v8m-3-3 3 3 3-3"/></svg></span>
                    <b>Cloud Solutions</b>
                    <small>Service image · 1000 × 700 px</small>
                </div>
            <?php endif; ?>
        </div>
        <ul class="accounting-benefit-list" data-reveal="right" aria-label="Benefits of our cloud solutions">
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7 18a4 4 0 1 1 .8-7.9A5.5 5.5 0 0 1 18 9a4.5 4.5 0 1 1 0 9Z"/><path d="M12 12v8m-3-3 3 3 3-3"/></svg></span><span><b>Scalable Infrastructure</b><small>Grow your resources as your business grows.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span><span><b>Enhanced Security</b><small>Protect your data with industry best practices.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v14c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 10c0 1.7 3.6 3 8 3s8-1.3 8-3"/></svg></span><span><b>Cost Efficiency</b><small>Reduce IT costs and optimise resource usage.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2M5 4 3 2m16 2 2-2"/></svg></span><span><b>Business Continuity</b><small>Keep your business running without disruption.</small></span></li>
        </ul>
    </section>

    <section class="accounting-services section-shell" aria-labelledby="key-cloud-services">
        <div class="accounting-section-heading" data-reveal="up">
            <p class="eyebrow"><span class="eyebrow-line"></span>Flexible cloud built around your needs</p>
            <h2 id="key-cloud-services">Key Cloud Services</h2>
            <p>Secure cloud solutions to connect your people, protect your data and support growth.</p>
        </div>
        <div class="accounting-service-grid">
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7 18a4 4 0 1 1 .8-7.9A5.5 5.5 0 0 1 18 9a4.5 4.5 0 1 1 0 9Z"/><path d="M12 17V9m-3 3 3-3 3 3"/></svg></span>
                <h3>Cloud Migration</h3>
                <p>Plan and migrate your applications, data and systems to the cloud with minimal disruption.</p>
                <a href="contact" aria-label="Ask us about cloud migration">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="8" rx="2"/><rect x="3" y="13" width="18" height="8" rx="2"/><path d="M7 7h.01M7 17h.01M11 7h6m-6 10h6"/></svg></span>
                <h3>Cloud Infrastructure Management</h3>
                <p>Setup, monitoring and ongoing management of AWS, Microsoft Azure and Google Cloud infrastructure.</p>
                <a href="contact" aria-label="Ask us about cloud infrastructure management">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8m-8 4h8"/></svg></span>
                <h3>Microsoft 365 Solutions</h3>
                <p>Implementation, management and support for Microsoft 365 including email, Teams, SharePoint and OneDrive.</p>
                <a href="contact" aria-label="Ask us about Microsoft 365 solutions">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v14c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 10c0 1.7 3.6 3 8 3s8-1.3 8-3m-16 5c0 1.7 3.6 3 8 3s8-1.3 8-3"/><path d="m3 3 2 2m14 14 2 2"/></svg></span>
                <h3>Cloud Backup &amp; Disaster Recovery</h3>
                <p>Secure backup solutions and disaster recovery planning to protect your critical data.</p>
                <a href="contact" aria-label="Ask us about cloud backup and disaster recovery">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span>
                <h3>Cloud Security</h3>
                <p>Security configuration, monitoring and compliance across your cloud environments.</p>
                <a href="contact" aria-label="Ask us about cloud security">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-1.7 2.9-.2-.1a1.7 1.7 0 0 0-1.8.2l-.2.1h-3.4M4.6 9a1.7 1.7 0 0 0-.3-1.9l-.1-.1 1.7-2.9.2.1a1.7 1.7 0 0 0 1.8-.2l.2-.1"/></svg></span>
                <h3>Optimisation &amp; Cost Management</h3>
                <p>Analyse and optimise your cloud usage to reduce costs and improve performance.</p>
                <a href="contact" aria-label="Ask us about cloud optimisation and cost management">↗</a>
            </article>
        </div>
    </section>

    <section class="finance-value-band" aria-labelledby="cloud-value-title">
        <div class="finance-value-inner section-shell" data-reveal="up">
            <div class="finance-value-copy">
                <p class="eyebrow"><span class="eyebrow-line"></span>Why choose our cloud solutions</p>
                <h2 id="cloud-value-title">A Smarter Cloud Strategy for <span>Business Growth</span></h2>
                <p>We combine technical expertise with a client-focused approach to deliver cloud solutions that are secure, scalable and aligned with your business goals.</p>
                <a class="button button-primary" href="contact">Talk to Our Team <span class="button-arrow" aria-hidden="true">→</span></a>
            </div>
            <div class="finance-value-points it-value-points">
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span><b>Certified Cloud<br>Professionals</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7 18a4 4 0 1 1 .8-7.9A5.5 5.5 0 0 1 18 9a4.5 4.5 0 1 1 0 9Z"/><path d="M5 12h14"/></svg></span><b>Multi-Cloud<br>Expertise</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span><b>Enhanced<br>Data Security</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span><b>Improved<br>Collaboration</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v14c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 10c0 1.7 3.6 3 8 3s8-1.3 8-3"/></svg></span><b>Cost<br>Optimisation</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 13v-2a8 8 0 0 1 16 0v2"/><path d="M4 13H2v5h4v-5zm16 0h2v5h-4v-5zM6 18a6 6 0 0 0 6 4h2"/></svg></span><b>Ongoing Support<br>&amp; Maintenance</b></article>
            </div>
        </div>
    </section>

        <?php require __DIR__ . '/includes/process-section.php'; ?>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
