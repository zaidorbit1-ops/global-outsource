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
        'flag' => 'UK',
        'paths' => ['assets/markets/United Kingdom.png', 'assets/markets/united-kingdom.png', 'assets/images/markets/United Kingdom.png', 'assets/images/markets/united-kingdom.png'],
        'alt' => 'View of the United Kingdom',
    ],
    [
        'name' => 'Ireland',
        'flag' => 'Ireland',
        'paths' => ['assets/markets/Ireland.png', 'assets/markets/ireland.png', 'assets/images/markets/Ireland.png', 'assets/images/markets/ireland.png'],
        'alt' => 'View of Ireland',
    ],
    [
        'name' => 'United States',
        'flag' => 'USA',
        'paths' => ['assets/markets/United States.png', 'assets/markets/united-states.png', 'assets/images/markets/United States.png', 'assets/images/markets/united-states.png'],
        'alt' => 'View of the United States',
    ],
];
$heroArtwork = 'assets/hero/hero.png';

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
                    <img class="hero-artwork" src="<?= htmlspecialchars($heroArtwork, ENT_QUOTES, 'UTF-8') ?>" alt="Global Outsource's team supporting clients around the world" width="1600" height="1080">
                <?php else: ?>
                    <div class="hero-artwork-placeholder" role="img" aria-label="Pakistan-based Global Outsource team image will appear here">
                        <span class="about-placeholder-mark" aria-hidden="true">GO</span>
                        <b>Pakistan-based team.<br>Global vision.</b>
                    </div>
                <?php endif; ?>
            </div>
            <div class="hero-visual-note"><span class="about-note-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span><span><b>One connected team</b><small>Working across borders and time zones</small></span></div>
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
                <span class="service-art" aria-hidden="true"><img src="assets/services/accounting-finance.png" alt="" width="720" height="440"></span>
                <span class="service-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 20V9m5 11V5m5 15v-8m5 8V3M2 21h20"/><path d="m3 7 5-4 5 3 7-5"/></svg></span>
                <span class="service-content"><b>Accountancy &amp;<br>Finance Outsourcing</b><span>Bookkeeping, payroll, management accounts, tax support and financial reporting for UK, Ireland and USA clients.</span></span>
                <span class="card-arrow" aria-hidden="true">↗</span>
            </a>
            <a class="service-card" href="it-solutions" data-reveal="up">
                <span class="service-art" aria-hidden="true"><img src="assets/services/it-solutions.png" alt="" width="720" height="440"></span>
                <span class="service-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7 18a4 4 0 1 1 .8-7.9A5.5 5.5 0 0 1 18 9a4.5 4.5 0 1 1 0 9Z"/><path d="M12 12v8m-3-3 3 3 3-3"/></svg></span>
                <span class="service-content"><b>IT Solutions</b><span>Managed IT services, cloud solutions, infrastructure support and cybersecurity.</span></span>
                <span class="card-arrow" aria-hidden="true">↗</span>
            </a>
            <a class="service-card" href="ai-solutions" data-reveal="up">
                <span class="service-art" aria-hidden="true"><img src="assets/services/ai-solutions.png" alt="" width="720" height="440"></span>
                <span class="service-icon" aria-hidden="true"><svg viewBox="0 0 24 24" data-lucide="sparkles"></svg></span>
                <span class="service-content"><b>AI Solutions</b><span>Automation, data analytics and intelligent solutions to drive business efficiency.</span></span>
                <span class="card-arrow" aria-hidden="true">↗</span>
            </a>
            <a class="service-card" href="software-development" data-reveal="up">
                <span class="service-art" aria-hidden="true"><img src="assets/services/software-development.png" alt="" width="720" height="440"></span>
                <span class="service-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="m8 8-4 4 4 4m8-8 4 4-4 4m-3-9-2 10"/></svg></span>
                <span class="service-content"><b>Software Development</b><span>Custom software, web and mobile applications, and systems integration tailored to your business needs.</span></span>
                <span class="card-arrow" aria-hidden="true">↗</span>
            </a>
        </div>
    </section>

    <section class="benefits-band" aria-label="Why work with Global Outsource">
        <div class="benefits-inner section-shell" data-reveal="up">
            <article class="benefit-item"><span class="benefit-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v4c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 9v4c0 1.7 3.6 3 8 3m8-7v1M4 13v4c0 1.7 3.6 3 8 3 1.2 0 2.4-.1 3.4-.3m4.6-8v4"/></svg></span><span><b>Cost Effective<br>Solutions</b><small>High quality services at competitive costs.</small></span></article>
            <article class="benefit-item"><span class="benefit-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span><span><b>Skilled &amp; Qualified<br>Professionals</b><small>Experienced team with international exposure.</small></span></article>
            <article class="benefit-item"><span class="benefit-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span><span><b>Confidential &amp; Secure</b><small>Your data and information are always safe.</small></span></article>
            <article class="benefit-item"><span class="benefit-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 3v18h18M7 14l4-4 4 3 6-7"/><path d="M16 6h5v5"/></svg></span><span><b>Scalable Support</b><small>Flexible solutions for your business needs.</small></span></article>
        </div>
    </section>

    <section class="about-section section-shell" id="about" aria-labelledby="about-title">
        <div class="about-principles" data-reveal="left">
            <p class="principles-kicker">Your business, moving forward</p>
            <p class="principles-statement">Built in Pakistan.<br><span>Ready for the world.</span></p>
            <div class="principle-row"><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6 3h9l4 4v18H6z"/><path d="M14 3v5h5M9 13h7m-7 4 2 2 4-4"/></svg></span><b>International best practices</b></div>
            <div class="principle-row"><span aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span><b>Skilled, dedicated professionals</b></div>
            <div class="principle-row"><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M8 12 5.5 9.5a2.1 2.1 0 0 0-3 3L7 17a4 4 0 0 0 5.7 0l1.3-1.3m2-3.7 2.5-2.5a2.1 2.1 0 0 1 3 3L17 17a4 4 0 0 1-5.7 0l-1.3-1.3"/></svg></span><b>Long-term client partnerships</b></div>
        </div>
        <div class="about-copy" data-reveal="right">
            <p class="eyebrow"><span class="eyebrow-line"></span>Why Global Outsource</p>
            <h2 id="about-title">Global Expertise<br>Delivered <span>from Pakistan</span></h2>
            <p>We combine a highly skilled Pakistani workforce, modern technology and international best practices to deliver reliable services to the UK, Ireland and USA. Our focus is on building long-term partnerships, helping businesses achieve efficiency, growth and success.</p>
            <a class="button button-primary" href="about">About Us <span class="button-arrow" aria-hidden="true">→</span></a>
            <div class="about-stat"><span class="about-stat-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span><span>One trusted partner for your global business needs</span></div>
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
                <?php
                $flagImage = null;
                foreach ($flagImages[$image['flag']]['paths'] as $candidateFlagPath) {
                    if (is_file(__DIR__ . '/' . $candidateFlagPath)) {
                        $flagImage = $candidateFlagPath;
                        break;
                    }
                }
                ?>
                <div class="market-card-heading">
                    <?php if ($flagImage !== null): ?>
                        <img class="market-card-flag" src="<?= htmlspecialchars($flagImage, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($flagImages[$image['flag']]['alt'], ENT_QUOTES, 'UTF-8') ?>" width="34" height="34" loading="lazy">
                    <?php endif; ?>
                    <h3><?= htmlspecialchars($image['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                </div>
                <ul>
                    <li><svg viewBox="0 0 24 24" data-lucide="chevron-right" aria-hidden="true"></svg>Accountancy Support</li>
                    <li><svg viewBox="0 0 24 24" data-lucide="chevron-right" aria-hidden="true"></svg>IT &amp; Cloud Solutions</li>
                    <li><svg viewBox="0 0 24 24" data-lucide="chevron-right" aria-hidden="true"></svg>AI &amp; Automation</li>
                    <li><svg viewBox="0 0 24 24" data-lucide="chevron-right" aria-hidden="true"></svg>Software Development</li>
                </ul>
                <a class="market-card-action" href="markets" aria-label="Learn more about <?= htmlspecialchars($image['name'], ENT_QUOTES, 'UTF-8') ?>"><svg viewBox="0 0 24 24" data-lucide="arrow-right" aria-hidden="true"></svg></a>
            </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="expertise-section" id="expertise" aria-labelledby="expertise-title" data-reveal="up">
        <div class="expertise-inner section-shell">
            <div class="expertise-art" aria-hidden="true">
                <div class="tech-rings"><span></span><span></span><span></span></div><div class="tech-chip"><span aria-hidden="true"><svg viewBox="0 0 24 24" data-lucide="sparkles"></svg></span><b>AI</b><small>INTELLIGENCE</small></div>
                <span class="tech-node node-one"><svg viewBox="0 0 24 24"><path d="m12 3 8 4v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V7l8-4Zm-3 9 2 2 4-4"/></svg></span><span class="tech-node node-two"><svg viewBox="0 0 24 24"><path d="M7 18a4 4 0 1 1 .8-7.9A5.5 5.5 0 0 1 18 9a4.5 4.5 0 1 1 0 9Z"/><path d="M12 12v8m-3-3 3 3 3-3"/></svg></span><span class="tech-node node-three"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8M15 7h5v5"/></svg></span>
            </div>
            <div class="expertise-copy">
                <p class="eyebrow"><span class="eyebrow-line"></span>Our expertise</p>
                <h2 id="expertise-title">Leveraging Technology<br>for a <span>Smarter Tomorrow</span></h2>
                <p>We use the latest technology, AI tools and secure infrastructure to deliver efficient, accurate and innovative solutions, helping our clients stay ahead in a digital world.</p>
                <a class="button button-primary" href="expertise">Our Expertise <span class="button-arrow" aria-hidden="true">→</span></a>
            </div>
            <ul class="expertise-list">
                <li><span><svg viewBox="0 0 24 24" data-lucide="sparkles" aria-hidden="true"></svg></span>AI &amp; Automation</li>
                <li><span><svg viewBox="0 0 24 24"><path d="M7 18a4 4 0 1 1 .8-7.9A5.5 5.5 0 0 1 18 9a4.5 4.5 0 1 1 0 9Z"/><path d="M12 12v8m-3-3 3 3 3-3"/></svg></span>Cloud Solutions</li>
                <li><span><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span>Cybersecurity</li>
                <li><span><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5"/></svg></span>Data Analytics</li>
                <li><span><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>Process Optimisation</li>
            </ul>
        </div>
    </section>

    <section class="trust-section section-shell" aria-label="Client testimonials and our values">
        <div class="testimonial" data-reveal="left">
            <div class="testimonial-slider" aria-roledescription="carousel" aria-label="Sample client testimonials">
                <div class="testimonial-content" aria-live="polite" aria-atomic="true">
                    <span class="sample-label"></span>
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
            <div><span class="trust-value-icon" aria-hidden="true"><svg viewBox="0 0 24 24" data-lucide="handshake"></svg></span><b>Long-Term<br>Partnerships</b></div><div><span class="trust-value-icon" aria-hidden="true"><svg viewBox="0 0 24 24" data-lucide="badge-check"></svg></span><b>Client Success<br>Focused</b></div><div><span class="trust-value-icon" aria-hidden="true"><svg viewBox="0 0 24 24" data-lucide="lightbulb"></svg></span><b>Continuous<br>Learning</b></div><div><span class="trust-value-icon" aria-hidden="true"><svg viewBox="0 0 24 24" data-lucide="globe-2"></svg></span><b>Global<br>Opportunities</b></div>
        </div>
    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
