<?php
declare(strict_types=1);

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; script-src 'self'; connect-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'");

$currentPage = 'about';
$pageTitle = 'About Us | Global Outsource';
$pageDescription = 'Learn about Global Outsource, a Pakistan-based outsourcing company supporting businesses in the UK, Ireland and USA.';
$breadcrumbItems = [
    ['label' => 'Home', 'url' => 'index'],
    ['label' => 'About Us'],
];
$companyImage = 'assets/about/pakistan-based-company.png';
$pageBannerTitle = 'About';
$pageBannerAccent = 'Global Outsource';
$pageBannerEyebrow = 'Global talent. Professional expertise. International standards.';
$pageBannerTagline = 'People. Technology. Global Opportunities.';
$pageBannerDescription = 'Global Outsource Pvt Ltd is a Pakistan-based professional outsourcing company providing Accountancy and IT solutions, AI, and Software Development services exclusively to clients in the UK, Ireland and USA.';
$whyPakistanImage = 'assets/about/why-pakistan.png';
$commitmentImage = 'assets/about/our-commitment.png';

require __DIR__ . '/includes/header.php';
?>

<main id="main-content" class="about-page">
    <?php require __DIR__ . '/includes/page-banner.php'; ?>

    <section class="about-highlights section-shell" aria-label="Global Outsource at a glance" data-reveal="up">
        <article class="about-highlight">
            <span class="about-highlight-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 0 1 0 18m0-18a15 15 0 0 0 0 18"/></svg></span>
            <span><b>UK, Ireland &amp; USA Clients Only</b><small>Focused international markets</small></span>
        </article>
        <article class="about-highlight">
            <span class="about-highlight-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span>
            <span><b>Skilled Professionals</b><small>Qualified and experienced team</small></span>
        </article>
        <article class="about-highlight">
            <span class="about-highlight-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 2v3m0 14v3M4.9 4.9 7 7m10 10 2.1 2.1M2 12h3m14 0h3M4.9 19.1 7 17m10-10 2.1-2.1"/><circle cx="12" cy="12" r="6"/></svg></span>
            <span><b>Cost Effective Solutions</b><small>High quality with global standards</small></span>
        </article>
        <article class="about-highlight">
            <span class="about-highlight-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span>
            <span><b>Confidential &amp; Secure</b><small>Your data and information are safe</small></span>
        </article>
    </section>

    <section class="about-story section-shell" aria-labelledby="about-story-title">
        <div class="about-story-visual" data-reveal="left">
            <div class="about-story-image">
                <?php if (is_file(__DIR__ . '/' . $companyImage)): ?>
                    <img src="<?= htmlspecialchars($companyImage, ENT_QUOTES, 'UTF-8') ?>" alt="A professional Pakistan-based Global Outsource workplace" width="1000" height="700" loading="lazy">
                <?php else: ?>
                    <div class="about-image-placeholder about-image-placeholder-story" role="img" aria-label="Pakistan-based company workplace image placeholder">
                        <span class="about-placeholder-mark" aria-hidden="true">GO</span>
                        <b>Built in Pakistan.<br>Ready for the world.</b>
                        <small>Same company image used throughout</small>
                    </div>
                <?php endif; ?>
            </div>
            <div class="about-story-caption"><span aria-hidden="true">✦</span><b>Rooted in Pakistan.<br>Connected to the world.</b></div>
        </div>
        <div class="about-story-copy" data-reveal="right">
            <p class="eyebrow"><span class="eyebrow-line"></span>Our Story</p>
            <h2 id="about-story-title">A Pakistan-Based Company<br>with a <span>Global Vision</span></h2>
            <p>Global Outsource Pvt Ltd was established with the vision to provide high-quality, reliable and cost-effective professional outsourcing services to international clients, with a focus on the UK, Ireland and USA.</p>
            <p>We combine skilled professionals, modern technology and a commitment to excellence, enabling businesses to reduce costs, increase efficiency and achieve sustainable growth. Our team in Pakistan works as an extension of your business, delivering reliable support with a focus on quality, confidentiality and client success.</p>
            <div class="about-story-proof"><span aria-hidden="true">✓</span>Professional support, built around your business</div>
        </div>
    </section>

    <section class="about-principles-grid section-shell" aria-label="Our mission, vision and values">
        <article class="about-principle-card" data-reveal="up">
            <span class="about-principle-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.5"/><path d="m15.5 8.5 5-5"/></svg></span>
            <p class="about-card-kicker">Our Mission</p>
            <h3>Meaningful work.<br>Measurable impact.</h3>
            <p>To deliver high-quality outsourcing solutions that create real value for our global clients through skilled people, innovative technology and a commitment to excellence.</p>
        </article>
        <article class="about-principle-card" data-reveal="up">
            <span class="about-principle-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg></span>
            <p class="about-card-kicker">Our Vision</p>
            <h3>A trusted global<br>outsourcing partner.</h3>
            <p>To be a trusted and leading outsourcing partner for businesses in the UK, Ireland and USA, recognised for reliability, innovation and client success.</p>
        </article>
        <article class="about-principle-card about-values-card" data-reveal="up">
            <span class="about-principle-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="m12 2 3 6.1 6.7 1-4.9 4.8L18 21l-6-3.2L6 21l1.2-7.1-4.9-4.8 6.7-1z"/></svg></span>
            <p class="about-card-kicker">Our Values</p>
            <h3>Principles we work by.</h3>
            <ul>
                <li><span aria-hidden="true">✓</span>Integrity and professionalism</li>
                <li><span aria-hidden="true">✓</span>Quality and accuracy</li>
                <li><span aria-hidden="true">✓</span>Confidentiality and data security</li>
                <li><span aria-hidden="true">✓</span>Client-focused approach</li>
                <li><span aria-hidden="true">✓</span>Continuous learning and innovation</li>
            </ul>
        </article>
    </section>

    <section class="about-pakistan" aria-labelledby="why-pakistan-title">
        <div class="about-pakistan-inner section-shell">
            <div class="about-pakistan-copy" data-reveal="left">
                <p class="eyebrow"><span class="eyebrow-line"></span>Why Pakistan?</p>
                <h2 id="why-pakistan-title">A Strategic Location for<br><span>Global Outsourcing</span></h2>
                <p>Pakistan offers a strong pool of qualified professionals, a growing technology sector, and a cost-effective operating environment, making it an ideal base for high-quality outsourcing services for clients in the UK, Ireland and USA.</p>
                <a class="button button-primary" href="expertise">Our Expertise <span class="button-arrow" aria-hidden="true">→</span></a>
            </div>
            <div class="about-pakistan-visual" data-reveal="up">
                <?php if (is_file(__DIR__ . '/' . $whyPakistanImage)): ?>
                    <img src="<?= htmlspecialchars($whyPakistanImage, ENT_QUOTES, 'UTF-8') ?>" alt="Map showing Global Outsource connecting Pakistan with clients in the United Kingdom, Ireland and the United States" width="1536" height="1024" loading="lazy">
                <?php else: ?>
                    <div class="why-pakistan-art" role="img" aria-label="Pakistan business and technology landscape illustration placeholder">
                        <div class="why-art-sun"></div><div class="why-art-mountain"></div><div class="why-art-city"><i></i><i></i><i></i><i></i><i></i></div>
                        <span class="why-art-label"><b>PAKISTAN</b><small>Local talent. Global opportunity.</small></span>
                        <span class="why-art-route route-one" aria-hidden="true"></span><span class="why-art-route route-two" aria-hidden="true"></span>
                        <span class="why-art-pin pin-karachi"><b>Karachi</b></span><span class="why-art-pin pin-global"><b>Global</b></span>
                    </div>
                <?php endif; ?>
            </div>
            <ul class="about-pakistan-benefits" data-reveal="right">
                <li><span aria-hidden="true">01</span><b>Skilled &amp; Educated Workforce</b></li>
                <li><span aria-hidden="true">02</span><b>Strong IT &amp; Professional Talent</b></li>
                <li><span aria-hidden="true">03</span><b>Cost Competitive Solutions</b></li>
                <li><span aria-hidden="true">04</span><b>Excellent English Communication</b></li>
                <li><span aria-hidden="true">05</span><b>Supportive Time Zone for UK, Ireland &amp; USA</b></li>
            </ul>
        </div>
    </section>

    <section class="about-commitment section-shell" aria-labelledby="about-commitment-title">
        <div class="commitment-visual" data-reveal="left">
            <?php if (is_file(__DIR__ . '/' . $commitmentImage)): ?>
                <img src="<?= htmlspecialchars($commitmentImage, ENT_QUOTES, 'UTF-8') ?>" alt="Global Outsource professionals working together to support international clients" width="1100" height="700" loading="lazy">
            <?php else: ?>
                <div class="commitment-placeholder" role="img" aria-label="Global Outsource team collaboration image placeholder">
                    <span class="commitment-orbit" aria-hidden="true"></span>
                    <span class="commitment-placeholder-content"><b>Partnership in action</b><small>People · Technology · Progress</small></span>
                    <span class="commitment-placeholder-chip chip-one">UK</span><span class="commitment-placeholder-chip chip-two">IE</span><span class="commitment-placeholder-chip chip-three">US</span>
                </div>
            <?php endif; ?>
        </div>
        <div class="about-commitment-copy" data-reveal="right">
            <p class="eyebrow"><span class="eyebrow-line"></span>Our Commitment</p>
            <h2 id="about-commitment-title">Your Success is <span>Our Priority</span></h2>
            <p>We are committed to building long-term partnerships with our clients by delivering reliable, efficient and high-quality outsourcing solutions. Our team works with dedication, integrity and a proactive approach to ensure your business goals are achieved.</p>
            <div class="commitment-pillars">
                <div><span aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span><b>People<br>Focused</b></div>
                <div><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 2v3m0 14v3M4.9 4.9 7 7m10 10 2.1 2.1M2 12h3m14 0h3M4.9 19.1 7 17m10-10 2.1-2.1"/><circle cx="12" cy="12" r="6"/></svg></span><b>Technology<br>Driven</b></div>
                <div><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5"/></svg></span><b>Global<br>Opportunities</b></div>
                <div><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M8 12 5.5 9.5a2.1 2.1 0 0 0-3 3L7 17a4 4 0 0 0 5.7 0l1.3-1.3m2-3.7 2.5-2.5a2.1 2.1 0 0 1 3 3L17 17a4 4 0 0 1-5.7 0l-1.3-1.3M7 8l2-2a4 4 0 0 1 5.7 0l2.3 2.3M9 12l3 3m1-5 2 2m-5-4 2 2"/></svg></span><b>Long-Term<br>Partnerships</b></div>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
