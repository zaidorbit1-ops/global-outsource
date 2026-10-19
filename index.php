<?php
declare(strict_types=1);

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; script-src 'self'; connect-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'");

$flagImages = [
    'UK' => [
        'paths' => ['assets/flags/United Kingdom.png', 'assets/flags/united-kingdom.png', 'assets/images/flags/United Kingdom.png', 'assets/images/flags/united-kingdom.png'],
        'alt' => 'United Kingdom flag',
    ],
    'Ireland' => [
        'paths' => ['assets/flags/Ireland.png', 'assets/flags/ireland.png', 'assets/images/flags/Ireland.png', 'assets/images/flags/ireland.png'],
        'alt' => 'Ireland flag',
    ],
    'USA' => [
        'paths' => ['assets/flags/United States.png', 'assets/flags/united-states.png', 'assets/images/flags/United States.png', 'assets/images/flags/united-states.png'],
        'alt' => 'United States flag',
    ],
];
$marketImages = [
    [
        'name' => 'United Kingdom',
        'paths' => ['assets/markets/United Kingdom.png', 'assets/markets/united-kingdom.png', 'assets/images/markets/United Kingdom.png', 'assets/images/markets/united-kingdom.png'],
        'alt' => 'View of the United Kingdom',
    ],
    [
        'name' => 'Ireland',
        'paths' => ['assets/markets/Ireland.png', 'assets/markets/ireland.png', 'assets/images/markets/Ireland.png', 'assets/images/markets/ireland.png'],
        'alt' => 'View of Ireland',
    ],
    [
        'name' => 'United States',
        'paths' => ['assets/markets/United States.png', 'assets/markets/united-states.png', 'assets/images/markets/United States.png', 'assets/images/markets/united-states.png'],
        'alt' => 'View of the United States',
    ],
];
$heroArtwork = 'assets/about/pakistan-based-company.png';

require __DIR__ . '/includes/header.php';
?>

<main id="main-content">
    <section class="hero section-shell" id="home" aria-labelledby="hero-title">
        <div class="hero-copy" data-reveal="left">
            <p class="eyebrow"><span class="eyebrow-line"></span>People <span aria-hidden="true">|</span> Technology <span aria-hidden="true">|</span> Global Opportunities</p>
            <h1 id="hero-title">Your Trusted<br><span class="hero-title-second">Outsourcing <span>Partner</span></span></h1>
            <p class="hero-description">We provide Accountancy and IT Solutions, AI and Software Development services to clients in the UK, Ireland and USA. Helping businesses reduce costs, increase efficiency and achieve sustainable growth.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="contact">Get a Free Consultation <span class="button-arrow" aria-hidden="true">→</span></a>
                <a class="button button-secondary" href="#services">Our Services <span class="button-play" aria-hidden="true">›</span></a>
            </div>
            <div class="country-list" aria-label="Our markets">
                <?php foreach ($flagImages as $country => $image): ?>
                    <span class="country-item">
                        <?php
                        $flagPath = null;
                        foreach ($image['paths'] as $candidatePath) {
                            if (is_file(__DIR__ . '/' . $candidatePath)) {
                                $flagPath = $candidatePath;
                                break;
                            }
                        }
                        ?>
                        <?php if ($flagPath !== null): ?>
                            <img class="flag-image" src="<?= htmlspecialchars($flagPath, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($image['alt'], ENT_QUOTES, 'UTF-8') ?>" width="96" height="48">
                        <?php else: ?>
                            <span class="flag-placeholder" aria-hidden="true">+</span>
                        <?php endif; ?>
                        <span><?= htmlspecialchars($country, ENT_QUOTES, 'UTF-8') ?></span>
                    </span>
                <?php endforeach; ?>
            </div>
            <div class="hero-proof"><span class="proof-dot"></span>Global talent. Local understanding.</div>
        </div>
        <div class="hero-visual" data-reveal="right">
            <div class="hero-artwork-shape" aria-hidden="true"></div>
            <div class="hero-artwork-frame">
                <?php if (is_file(__DIR__ . '/' . $heroArtwork)): ?>
                    <img class="hero-artwork" src="<?= htmlspecialchars($heroArtwork, ENT_QUOTES, 'UTF-8') ?>" alt="Global Outsource's Pakistan-based team collaborating in their office" width="1672" height="941">
                <?php else: ?>
                    <div class="hero-artwork-placeholder" role="img" aria-label="Pakistan-based Global Outsource team image will appear here">
                        <span class="about-placeholder-mark" aria-hidden="true">GO</span>
                        <b>Pakistan-based team.<br>Global vision.</b>
                    </div>
                <?php endif; ?>
            </div>
            <div class="hero-visual-note"><span class="about-note-icon" aria-hidden="true">↗</span><span><b>One connected team</b><small>Working across borders and time zones</small></span></div>
        </div>
    </section>

    <section class="services-section section-shell" id="services" aria-labelledby="services-title" data-reveal="up">
        <div class="section-heading-row">
            <div>
                <p class="eyebrow"><span class="eyebrow-line"></span>What we do</p>
                <h2 id="services-title">Our Services</h2>
            </div>
            <p class="section-intro">End-to-end outsourcing solutions for modern businesses.</p>
        </div>
        <div class="service-grid">
            <a class="service-card" href="accounting-finance" data-reveal="up">
                <span class="service-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 19V9m5 10V5m5 14v-7m5 7V3M2 20h20"/></svg></span>
                <span class="service-content"><b>Accountancy &amp;<br>Finance Outsourcing</b><span>Bookkeeping, payroll, management accounts, tax support and financial reporting for UK, Ireland and USA clients.</span></span>
                <span class="card-arrow" aria-hidden="true">↗</span>
            </a>
            <a class="service-card" href="it-solutions" data-reveal="up">
                <span class="service-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3 4 7v5c0 5 3.4 8 8 9 4.6-1 8-4 8-9V7zm-3 9 2 2 4-4"/></svg></span>
                <span class="service-content"><b>IT Solutions</b><span>Managed IT services, cloud solutions, infrastructure support and cybersecurity.</span></span>
                <span class="card-arrow" aria-hidden="true">↗</span>
            </a>
            <a class="service-card" href="ai-solutions" data-reveal="up">
                <span class="service-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3a3 3 0 0 0-3 3v1a3 3 0 0 0-3 3v1a3 3 0 0 0 0 6h1a3 3 0 0 0 6 0V6a3 3 0 0 0-1-2.2M12 3a3 3 0 0 1 3 3v1a3 3 0 0 1 3 3v1a3 3 0 0 1 0 6h-1a3 3 0 0 1-6 0V6a3 3 0 0 1 1-2.2M9 11h.01M15 11h.01M9 15h.01M15 15h.01"/></svg></span>
                <span class="service-content"><b>AI Solutions</b><span>Automation, data analytics and intelligent solutions to drive business efficiency.</span></span>
                <span class="card-arrow" aria-hidden="true">↗</span>
            </a>
            <a class="service-card" href="software-development" data-reveal="up">
                <span class="service-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m8 8-4 4 4 4m8-8 4 4-4 4m-3-9-2 10"/></svg></span>
                <span class="service-content"><b>Software Development</b><span>Custom software, web and mobile applications, and systems integration tailored to your business needs.</span></span>
                <span class="card-arrow" aria-hidden="true">↗</span>
            </a>
        </div>
    </section>

    <section class="benefits-band" aria-label="Why work with Global Outsource">
        <div class="benefits-inner section-shell" data-reveal="up">
            <article class="benefit-item"><span class="benefit-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></span><span><b>Cost Effective<br>Solutions</b><small>High quality services at competitive costs.</small></span></article>
            <article class="benefit-item"><span class="benefit-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span><span><b>Skilled &amp; Qualified<br>Professionals</b><small>Experienced team with international exposure.</small></span></article>
            <article class="benefit-item"><span class="benefit-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span><span><b>Confidential &amp; Secure</b><small>Your data and information are always safe.</small></span></article>
            <article class="benefit-item"><span class="benefit-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 3v18h18M7 14l4-4 4 3 6-7"/><path d="M16 6h5v5"/></svg></span><span><b>Scalable Support</b><small>Flexible solutions for your business needs.</small></span></article>
        </div>
    </section>

    <section class="about-section section-shell" id="about" aria-labelledby="about-title">
        <div class="about-principles" data-reveal="left">
            <p class="principles-kicker">Your business, moving forward</p>
            <p class="principles-statement">Built in Pakistan.<br><span>Ready for the world.</span></p>
            <div class="principle-row"><span>01</span><b>International best practices</b></div>
            <div class="principle-row"><span>02</span><b>Skilled, dedicated professionals</b></div>
            <div class="principle-row"><span>03</span><b>Long-term client partnerships</b></div>
        </div>
        <div class="about-copy" data-reveal="right">
            <p class="eyebrow"><span class="eyebrow-line"></span>Why Global Outsource</p>
            <h2 id="about-title">Global Expertise<br>Delivered <span>from Pakistan</span></h2>
            <p>We combine a highly skilled Pakistani workforce, modern technology and international best practices to deliver reliable services to the UK, Ireland and USA. Our focus is on building long-term partnerships, helping businesses achieve efficiency, growth and success.</p>
            <a class="button button-primary" href="about">About Us <span class="button-arrow" aria-hidden="true">→</span></a>
            <div class="about-stat"><b>01</b><span>One trusted partner for your global business needs</span></div>
        </div>
    </section>

    <section class="markets-section section-shell" id="markets" aria-labelledby="markets-title" data-reveal="up">
        <div class="markets-copy">
            <p class="eyebrow"><span class="eyebrow-line"></span>Our markets</p>
            <h2 id="markets-title">Supporting Businesses in<br><span>Key International Markets</span></h2>
            <p>We provide outsourcing services exclusively to clients in the UK, Ireland and USA, with a deep understanding of their business and regulatory environments.</p>
            <a class="button button-primary" href="markets">Learn More <span class="button-arrow" aria-hidden="true">→</span></a>
        </div>
        <div class="market-cards">
            <?php foreach ($marketImages as $image): ?>
            <article class="market-card">
                <div class="market-image-wrap">
                    <?php
                    $marketPath = null;
                    foreach ($image['paths'] as $candidatePath) {
                        if (is_file(__DIR__ . '/' . $candidatePath)) {
                            $marketPath = $candidatePath;
                            break;
                        }
                    }
                    ?>
                    <?php if ($marketPath !== null): ?>
                        <img class="market-image" src="<?= htmlspecialchars($marketPath, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($image['alt'], ENT_QUOTES, 'UTF-8') ?>" width="720" height="440" loading="lazy">
                    <?php else: ?>
                        <div class="market-image-placeholder" role="img" aria-label="<?= htmlspecialchars($image['name'], ENT_QUOTES, 'UTF-8') ?> market image will appear here"><span><?= htmlspecialchars(strtoupper($image['name']), ENT_QUOTES, 'UTF-8') ?></span></div>
                    <?php endif; ?>
                </div>
                <h3><?= htmlspecialchars($image['name'], ENT_QUOTES, 'UTF-8') ?></h3><ul><li>Accountancy Support</li><li>IT &amp; Cloud Solutions</li><li>AI &amp; Automation</li><li>Software Development</li></ul>
            </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="expertise-section" id="expertise" aria-labelledby="expertise-title" data-reveal="up">
        <div class="expertise-inner section-shell">
            <div class="expertise-art" aria-hidden="true">
                <div class="tech-rings"><span></span><span></span><span></span></div><div class="tech-chip"><span>✦</span><b>AI</b><small>INTELLIGENCE</small></div>
                <span class="tech-node node-one">⌘</span><span class="tech-node node-two">⌁</span><span class="tech-node node-three">◈</span>
            </div>
            <div class="expertise-copy">
                <p class="eyebrow"><span class="eyebrow-line"></span>Our expertise</p>
                <h2 id="expertise-title">Leveraging Technology<br>for a <span>Smarter Tomorrow</span></h2>
                <p>We use the latest technology, AI tools and secure infrastructure to deliver efficient, accurate and innovative solutions, helping our clients stay ahead in a digital world.</p>
                <a class="button button-primary" href="expertise">Our Expertise <span class="button-arrow" aria-hidden="true">→</span></a>
            </div>
            <ul class="expertise-list">
                <li><span>✧</span>AI &amp; Automation</li><li><span>⌂</span>Cloud Solutions</li><li><span>◈</span>Cybersecurity</li><li><span>▥</span>Data Analytics</li><li><span>⌁</span>Process Optimisation</li>
            </ul>
        </div>
    </section>

    <section class="trust-section section-shell" aria-label="Client testimonials and our values">
        <div class="testimonial" data-reveal="left">
            <div class="testimonial-slider" aria-roledescription="carousel" aria-label="Sample client testimonials">
                <div class="testimonial-content" aria-live="polite" aria-atomic="true">
                    <span class="sample-label">Sample testimonial</span>
                    <span class="quote-mark" aria-hidden="true">“</span>
                    <p class="testimonial-text">Global Outsource has been a valuable partner, providing reliable support for our accounting and IT needs. Their team is professional, responsive and a pleasure to work with.</p>
                    <b class="testimonial-author">UK Client</b>
                    <small class="testimonial-sector">Professional Services Firm</small>
                </div>
                <div class="testimonial-controls">
                    <button class="testimonial-arrow" type="button" data-testimonial-prev aria-label="Previous testimonial">←</button>
                    <div class="testimonial-dots" role="group" aria-label="Choose a testimonial">
                        <button type="button" aria-label="Show testimonial 1" aria-current="true"></button>
                        <button type="button" aria-label="Show testimonial 2" aria-current="false"></button>
                        <button type="button" aria-label="Show testimonial 3" aria-current="false"></button>
                    </div>
                    <button class="testimonial-arrow" type="button" data-testimonial-next aria-label="Next testimonial">→</button>
                </div>
            </div>
        </div>
        <div class="trust-values" data-reveal="right">
            <div><span>♧</span><b>Long-Term<br>Partnerships</b></div><div><span>✣</span><b>Client Success<br>Focused</b></div><div><span>♧</span><b>Continuous<br>Learning</b></div><div><span>◎</span><b>Global<br>Opportunities</b></div>
        </div>
    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
