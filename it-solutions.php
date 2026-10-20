<?php
declare(strict_types=1);

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; script-src 'self'; connect-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'");

$currentPage = 'it-solutions';
$pageTitle = 'IT Solutions & Support | Global Outsource';
$pageDescription = 'Reliable, secure and scalable IT outsourcing, cloud, cybersecurity and infrastructure support for businesses in the UK, Ireland and USA.';
$breadcrumbItems = [
    ['label' => 'Home', 'url' => 'index'],
    ['label' => 'Services', 'url' => 'index#services'],
    ['label' => 'IT Solutions'],
];
$pageBannerTitle = 'IT';
$pageBannerAccent = 'Solutions';
$pageBannerEyebrow = 'Reliable, secure and scalable IT services for modern businesses.';
$pageBannerTagline = 'Technology that keeps your business moving.';
$pageBannerDescription = 'We provide end-to-end IT outsourcing solutions to businesses in the UK, Ireland and USA, helping them improve efficiency, reduce costs and stay secure with the latest technology.';
$itSolutionsImage = 'assets/services/it-solutions.png';

require __DIR__ . '/includes/header.php';
?>

<main id="main-content" class="service-page it-solutions-page">
    <?php require __DIR__ . '/includes/page-banner.php'; ?>

    <?php require __DIR__ . '/includes/service-switcher.php'; ?>

    <section class="accounting-intro section-shell" aria-labelledby="it-intro-title">
        <div class="accounting-intro-copy" data-reveal="left">
            <p class="eyebrow"><span class="eyebrow-line"></span>Our IT Solutions</p>
            <h2 id="it-intro-title">Comprehensive IT Support for a <span>Connected World</span></h2>
            <p>We deliver managed IT services, cloud solutions and cybersecurity support to help businesses operate efficiently, stay secure and stay ahead with modern technology. Our experienced team provides reliable and cost-effective IT solutions tailored to your business needs.</p>
            <a class="button button-primary" href="contact">Get a Free Consultation <span class="button-arrow" aria-hidden="true">→</span></a>
        </div>
        <div class="accounting-intro-image" data-reveal="right">
            <?php if (is_file(__DIR__ . '/' . $itSolutionsImage)): ?>
                <img src="<?= htmlspecialchars($itSolutionsImage, ENT_QUOTES, 'UTF-8') ?>" alt="IT professionals monitoring systems and providing secure technology support" width="1000" height="700">
            <?php else: ?>
                <div class="accounting-image-placeholder" role="img" aria-label="Add the IT solutions image at assets/services/it-solutions.png">
                    <span class="accounting-image-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="13" rx="2"/><path d="M8 21h8m-4-4v4m-5-13 2 2-2 2m5 0h3"/></svg></span>
                    <b>IT Solutions</b>
                    <small>Service image · 1000 × 700 px</small>
                </div>
            <?php endif; ?>
        </div>
        <ul class="accounting-benefit-list" data-reveal="right" aria-label="Benefits of our IT support">
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span><span><b>Secure Infrastructure</b><small>Keep your systems and data protected.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 8v5l3 2"/><circle cx="12" cy="12" r="9"/><path d="M5 3 3 5m16-2 2 2"/></svg></span><span><b>Business Continuity</b><small>Minimise downtime and risk.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5"/></svg></span><span><b>Scalable Solutions</b><small>Flexible IT support for your growth.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 13v-2a8 8 0 0 1 16 0v2"/><path d="M4 13H2v5h4v-5zm16 0h2v5h-4v-5zM6 18a6 6 0 0 0 6 4h2"/></svg></span><span><b>Expert Support</b><small>Experienced and responsive IT professionals.</small></span></li>
        </ul>
    </section>

    <section class="accounting-services section-shell" aria-labelledby="key-it-services">
        <div class="accounting-section-heading" data-reveal="up">
            <p class="eyebrow"><span class="eyebrow-line"></span>Technology you can rely on</p>
            <h2 id="key-it-services">Key IT Services</h2>
            <p>Practical, proactive support to keep your people and systems connected.</p>
        </div>
        <div class="accounting-service-grid it-service-grid">
            <article class="accounting-service-card" id="it-managed-services" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="13" rx="2"/><path d="M8 21h8m-4-4v4m-5-13h10m-10 3h6"/></svg></span>
                <h3>Managed IT Services</h3>
                <p>Proactive monitoring, maintenance and support to keep your business running smoothly.</p>
                <a href="managed-it-services" aria-label="Learn about managed IT services">↗</a>
            </article>
            <article class="accounting-service-card" id="it-cloud-solutions" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7 18a4 4 0 1 1 .8-7.9A5.5 5.5 0 0 1 18 9a4.5 4.5 0 1 1 0 9Z"/><path d="M12 12v8m-3-3 3 3 3-3"/></svg></span>
                <h3>Cloud Solutions</h3>
                <p>Setup, migration and management of cloud platforms including Microsoft 365, AWS and Google Cloud.</p>
                <a href="cloud-solutions" aria-label="Learn about cloud solutions">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span>
                <h3>Cybersecurity</h3>
                <p>Protect your business with security solutions, threat monitoring and risk management.</p>
                <a href="contact" aria-label="Ask us about cybersecurity">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="15" rx="2"/><path d="M7 8h10M7 12h10M7 16h4M8 22h8"/></svg></span>
                <h3>IT Infrastructure Support</h3>
                <p>Network setup, configuration and ongoing support for your IT infrastructure.</p>
                <a href="contact" aria-label="Ask us about IT infrastructure support">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 13v-2a8 8 0 0 1 16 0v2"/><path d="M4 13H2v5h4v-5zm16 0h2v5h-4v-5zM6 18a6 6 0 0 0 6 4h2"/></svg></span>
                <h3>Remote IT Support</h3>
                <p>Fast and reliable remote support to resolve issues and minimise downtime.</p>
                <a href="contact" aria-label="Ask us about remote IT support">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span>
                <h3>IT Helpdesk</h3>
                <p>Dedicated helpdesk support for your team with quick response times.</p>
                <a href="contact" aria-label="Ask us about IT helpdesk support">↗</a>
            </article>
        </div>
    </section>

    <section class="finance-value-band" aria-labelledby="it-value-title">
        <div class="finance-value-inner section-shell" data-reveal="up">
            <div class="finance-value-copy">
                <p class="eyebrow"><span class="eyebrow-line"></span>Why choose our IT solutions</p>
                <h2 id="it-value-title">Reliable IT Support for <span>Business Growth</span></h2>
                <p>We combine technical expertise, proactive support and a client-focused approach to deliver IT solutions that help your business stay efficient, secure and ready for the future.</p>
                <a class="button button-primary" href="contact">Talk to Our Team <span class="button-arrow" aria-hidden="true">→</span></a>
            </div>
            <div class="finance-value-points it-value-points">
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-1.7 2.9-.2-.1a1.7 1.7 0 0 0-1.8.2l-.2.1h-3.4l-.1-.2a1.7 1.7 0 0 0-1.8-.2l-.2.1-1.7-2.9.1-.1a1.7 1.7 0 0 0 .3-1.9l-.1-.2v-3.4l.2-.1a1.7 1.7 0 0 0 .2-1.8l-.1-.2 2.9-1.7.1.1a1.7 1.7 0 0 0 1.9.3l.2-.1h3.4l.1.2a1.7 1.7 0 0 0 1.8.2l.2-.1 1.7 2.9-.1.1a1.7 1.7 0 0 0-.3 1.9l.1.2v3.4z"/></svg></span><b>Experienced<br>IT Professionals</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span><b>Proactive<br>Monitoring</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v14c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 10c0 1.7 3.6 3 8 3s8-1.3 8-3m-16 5c0 1.7 3.6 3 8 3s8-1.3 8-3"/></svg></span><b>Cost-Effective<br>Solutions</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7 18a4 4 0 1 1 .8-7.9A5.5 5.5 0 0 1 18 9a4.5 4.5 0 1 1 0 9Z"/><path d="M12 12v8m-3-3 3 3 3-3"/></svg></span><b>Secure &amp; Scalable<br>Infrastructure</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 13v-2a8 8 0 0 1 16 0v2"/><path d="M4 13H2v5h4v-5zm16 0h2v5h-4v-5zM6 18a6 6 0 0 0 6 4h2"/></svg></span><b>Fast Response<br>Support</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5"/></svg></span><b>Focus on<br>Your Business</b></article>
            </div>
        </div>
    </section>

        <?php require __DIR__ . '/includes/process-section.php'; ?>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
