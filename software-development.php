<?php
declare(strict_types=1);

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; script-src 'self'; connect-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'");

$currentPage = 'software-development';
$pageTitle = 'Software Development Services | Global Outsource';
$pageDescription = 'Custom software solutions to turn your ideas into real business value, from web and mobile apps to integrations and modernisation.';
$breadcrumbItems = [
    ['label' => 'Home', 'url' => 'index'],
    ['label' => 'Services', 'url' => 'index#services'],
    ['label' => 'Software Development'],
];
$pageBannerTitle = 'Software';
$pageBannerAccent = 'Development';
$pageBannerEyebrow = 'Custom software solutions to turn your ideas into real business value.';
$pageBannerTagline = 'Build. Innovate. Grow.';
$pageBannerDescription = 'We design and develop scalable, high-performance software solutions tailored to your business requirements, helping you automate processes, improve efficiency and achieve your growth goals.';
$softwareImage = 'assets/services/software-development.png';

require __DIR__ . '/includes/header.php';
?>

<main id="main-content" class="service-page software-development-page">
    <?php require __DIR__ . '/includes/page-banner.php'; ?>

    <?php require __DIR__ . '/includes/service-switcher.php'; ?>

    <section class="accounting-intro section-shell" aria-labelledby="software-intro-title">
        <div class="accounting-intro-copy" data-reveal="left">
            <p class="eyebrow"><span class="eyebrow-line"></span>Our Software Development Services</p>
            <h2 id="software-intro-title">Build. Innovate. Grow. With <span>Custom Software</span></h2>
            <p>We develop modern, secure and scalable software solutions that help businesses streamline operations, enhance customer experiences and stay ahead in a digital world. Our experienced team works closely with you from concept to deployment, ensuring solutions that are practical, efficient and aligned with your business goals.</p>
            <a class="button button-primary" href="contact">Get a Free Consultation <span class="button-arrow" aria-hidden="true">→</span></a>
        </div>
        <div class="accounting-intro-image" data-reveal="right">
            <?php if (is_file(__DIR__ . '/' . $softwareImage)): ?>
                <img src="<?= htmlspecialchars($softwareImage, ENT_QUOTES, 'UTF-8') ?>" alt="Software developers building and testing custom digital products" width="1000" height="700">
            <?php else: ?>
                <div class="accounting-image-placeholder" role="img" aria-label="Add the software development image at assets/services/software-development.png">
                    <span class="accounting-image-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="m8 8-4 4 4 4m8-8 4 4-4 4m-3-9-2 10"/></svg></span>
                    <b>Software Development</b>
                    <small>Service image · 1000 × 700 px</small>
                </div>
            <?php endif; ?>
        </div>
        <ul class="accounting-benefit-list" data-reveal="right" aria-label="Benefits of our software development services">
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 3v18M3 12h18"/><circle cx="12" cy="12" r="9"/></svg></span><span><b>Tailored Solutions</b><small>Software built around your specific business needs.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5"/></svg></span><span><b>Scalable &amp; Flexible</b><small>Solutions designed to grow with your business.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="13" rx="2"/><path d="M8 21h8m-4-4v4m-5-9 2 2 4-4"/></svg></span><span><b>Modern Technologies</b><small>Using the latest frameworks, platforms and tools.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 13v-2a8 8 0 0 1 16 0v2"/><path d="M4 13H2v5h4v-5zm16 0h2v5h-4v-5zM6 18a6 6 0 0 0 6 4h2"/></svg></span><span><b>Ongoing Support</b><small>Continuous maintenance and enhancements.</small></span></li>
        </ul>
    </section>

    <section class="accounting-services section-shell" aria-labelledby="key-software-services">
        <div class="accounting-section-heading" data-reveal="up">
            <p class="eyebrow"><span class="eyebrow-line"></span>Software shaped around your goals</p>
            <h2 id="key-software-services">Key Services</h2>
            <p>From first idea to launch and beyond, we build software that solves real business challenges.</p>
        </div>
        <div class="accounting-service-grid">
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="14" rx="2"/><path d="M8 22h8m-4-4v4m-5-9 3-3 2 2 4-4"/></svg></span>
                <h3>Web Application Development</h3>
                <p>Custom web applications designed for performance, security and scalability.</p>
                <a href="contact" aria-label="Ask us about web application development">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="6" y="2" width="12" height="20" rx="2"/><path d="M10 5h4m-3 14h2"/></svg></span>
                <h3>Mobile App Development</h3>
                <p>Native and cross-platform mobile applications for iOS and Android.</p>
                <a href="contact" aria-label="Ask us about mobile app development">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 3 14 8l5-2-2 5 5 2-5 2 2 5-5-2-2 5-2-5-5 2 2-5-5-2 5-2-2-5 5 2z"/><circle cx="12" cy="13" r="2"/></svg></span>
                <h3>Custom Business Software</h3>
                <p>Tailored software solutions to meet your unique business requirements.</p>
                <a href="contact" aria-label="Ask us about custom business software">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M10 13a5 5 0 0 0 7.1 0l3-3A5 5 0 0 0 13 2.9l-1.7 1.7"/><path d="M14 11a5 5 0 0 0-7.1 0l-3 3A5 5 0 0 0 11 21.1l1.7-1.7"/></svg></span>
                <h3>API Development &amp; Integration</h3>
                <p>Seamless integration with third-party systems, APIs and existing software.</p>
                <a href="contact" aria-label="Ask us about API development and integration">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 4h18l-2 10H5L3 4Zm2 10-1 5h16l-1-5M8 19a2 2 0 1 0 4 0m2 0a2 2 0 1 0 4 0"/></svg></span>
                <h3>E-commerce Solutions</h3>
                <p>Online stores and marketplaces designed to drive sales and enhance customer experience.</p>
                <a href="contact" aria-label="Ask us about ecommerce solutions">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7 18a4 4 0 1 1 .8-7.9A5.5 5.5 0 0 1 18 9a4.5 4.5 0 1 1 0 9Z"/><path d="M12 12v8m-3-3 3 3 3-3"/></svg></span>
                <h3>System Modernisation</h3>
                <p>Upgrade and modernise legacy systems for better performance and scalability.</p>
                <a href="contact" aria-label="Ask us about system modernisation">↗</a>
            </article>
        </div>
    </section>

    <section class="finance-value-band" aria-labelledby="software-value-title">
        <div class="finance-value-inner section-shell" data-reveal="up">
            <div class="finance-value-copy">
                <p class="eyebrow"><span class="eyebrow-line"></span>Why choose our software development services</p>
                <h2 id="software-value-title">Technology Solutions for <span>Real Business Impact</span></h2>
                <p>We combine technical expertise with a deep understanding of business needs to deliver software solutions that are reliable, secure and designed for long-term success.</p>
                <a class="button button-primary" href="contact">Talk to Our Team <span class="button-arrow" aria-hidden="true">→</span></a>
            </div>
            <div class="finance-value-points it-value-points">
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span><b>Experienced<br>Development Team</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span><b>Secure &amp; High<br>Performance</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v14c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 10c0 1.7 3.6 3 8 3s8-1.3 8-3"/></svg></span><b>Cost-Effective<br>Solutions</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-1.7 2.9-.2-.1a1.7 1.7 0 0 0-1.8.2l-.2.1h-3.4"/></svg></span><b>Agile Development<br>Approach</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="m13 2-3 8h7L8 22l3-9H4z"/></svg></span><b>Scalable for<br>Future Growth</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 13v-2a8 8 0 0 1 16 0v2"/><path d="M4 13H2v5h4v-5zm16 0h2v5h-4v-5zM6 18a6 6 0 0 0 6 4h2"/></svg></span><b>Ongoing Support<br>&amp; Maintenance</b></article>
            </div>
        </div>
    </section>

    <section class="finance-process section-shell" aria-labelledby="software-process-title">
        <div class="accounting-section-heading" data-reveal="up">
            <p class="eyebrow"><span class="eyebrow-line"></span>Simple, structured, dependable</p>
            <h2 id="software-process-title">Our Process</h2>
        </div>
        <ol class="finance-process-list">
            <li data-reveal="up"><span class="process-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="10.5" cy="10.5" r="6.5"/><path d="m16 16 5 5"/></svg></span><span class="process-step">01</span><h3>Understand</h3><p>We learn about your business goals, challenges and requirements.</p></li>
            <li data-reveal="up"><span class="process-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6 3h9l4 4v14H6z"/><path d="M14 3v5h5M9 13h7m-7 4h7"/></svg></span><span class="process-step">02</span><h3>Plan</h3><p>We design a tailored solution with clear scope, technology and timeline.</p></li>
            <li data-reveal="up"><span class="process-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="m8 8-4 4 4 4m8-8 4 4-4 4m-3-9-2 10"/></svg></span><span class="process-step">03</span><h3>Develop</h3><p>Our team builds and tests the solution with regular updates.</p></li>
            <li data-reveal="up"><span class="process-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 13v-2a8 8 0 0 1 16 0v2"/><path d="M4 13H2v5h4v-5zm16 0h2v5h-4v-5zM6 18a6 6 0 0 0 6 4h2"/></svg></span><span class="process-step">04</span><h3>Deploy &amp; Support</h3><p>We launch the solution and provide ongoing support and improvements.</p></li>
        </ol>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
