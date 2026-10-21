<?php
declare(strict_types=1);

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; script-src 'self'; connect-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'");

$currentPage = 'markets';
$pageTitle = 'Markets We Serve | Global Outsource';
$pageDescription = 'Discover how Global Outsource supports businesses in the UK, Ireland and USA with local market knowledge and reliable global delivery.';
$breadcrumbItems = [
    ['label' => 'Home', 'url' => 'index'],
    ['label' => 'Markets We Serve'],
];
$pageBannerTitle = 'Markets';
$pageBannerAccent = 'We Serve';
$pageBannerEyebrow = 'Global reach. Local understanding.';
$pageBannerTagline = 'Supporting businesses across borders';
$pageBannerDescription = 'Explore the markets we serve and the tailored outsourcing support we provide to businesses around the world.';
$marketCountries = [
    [
        'name' => 'United Kingdom',
        'image' => 'assets/markets/united-kingdom.png',
        'imageAlt' => 'Big Ben and a red London bus in the United Kingdom',
        'flag' => 'assets/flags/united-kingdom.png',
        'description' => 'We support a wide range of businesses in the UK with accountancy, tax, payroll, managed IT services and business process support.',
    ],
    [
        'name' => 'Ireland',
        'image' => 'assets/markets/ireland.png',
        'imageAlt' => 'A historic Irish cathedral and colorful buildings',
        'flag' => 'assets/flags/ireland.png',
        'description' => 'A trusted outsourcing partner for businesses across Ireland, helping them achieve compliance, efficiency and sustainable growth.',
    ],
    [
        'name' => 'United States',
        'image' => 'assets/images/markets/united-states.png',
        'imageAlt' => 'The Statue of Liberty and New York City skyline',
        'flag' => 'assets/flags/united-states.png',
        'description' => 'We work with businesses in the USA to provide cost-effective, scalable support services tailored to their operational needs.',
    ],
];
$marketServices = [
    'Accountancy & Tax Support',
    'IT & Cloud Solutions',
    'AI & Automation',
    'Software Development',
    'Business Process Support',
];
$additionalMarkets = [
    ['name' => 'Canada', 'flag' => 'assets/flags/canada.png', 'code' => 'CA'],
    ['name' => 'Australia', 'flag' => 'assets/flags/australia.png', 'code' => 'AU'],
    ['name' => 'UAE', 'flag' => 'assets/flags/uae.png', 'code' => 'UAE'],
    ['name' => 'Saudi Arabia', 'flag' => 'assets/flags/saudia.png', 'code' => 'SA'],
    ['name' => 'Qatar', 'flag' => 'assets/flags/qatar.png', 'code' => 'QA'],
];
$marketBenefits = [
    ['icon' => 'M4 5h16M4 10h16M4 15h10M4 20h7', 'title' => 'Understanding of', 'detail' => 'Local Regulations'],
    ['icon' => 'M12 3v18m-9-9h18M5.6 5.6l12.8 12.8m0-12.8L5.6 18.4', 'title' => 'Multi-Country', 'detail' => 'Support'],
    ['icon' => 'M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m6-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7-3h5m-2.5-2.5v5', 'title' => 'Experienced', 'detail' => 'Professionals'],
    ['icon' => 'M12 2v20m8-16H8.5a3.5 3.5 0 0 0 0 7h7a3.5 3.5 0 0 1 0 7H4', 'title' => 'Cost-Effective', 'detail' => 'Solutions'],
    ['icon' => 'M3 17 9 11l4 4 8-9m-6 0h6v6', 'title' => 'Scalable', 'detail' => 'Service Delivery'],
    ['icon' => 'm12 3 8 4v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V7l8-4Zm-3 9 2 2 4-4', 'title' => 'Consistent Quality', 'detail' => 'Standards'],
];
$marketApproach = [
    ['icon' => 'M10.5 3a7.5 7.5 0 1 0 0 15 7.5 7.5 0 0 0 0-15ZM16 16l5 5', 'title' => 'Understand', 'text' => 'We assess your market requirements, regulatory needs and business goals.'],
    ['icon' => 'M6 3h9l4 4v14H6z M14 3v5h5M9 13h7m-7 4h7', 'title' => 'Plan', 'text' => 'We design a tailored solution for your market with clear scope and timelines.'],
    ['icon' => 'M3 20h18M5 17l5-5 4 3 6-8M15 7h5v5', 'title' => 'Deliver', 'text' => 'Our team delivers efficient, reliable services using the latest technology.'],
    ['icon' => 'M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m6-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7 1a4 4 0 0 1 3 4v2', 'title' => 'Support', 'text' => 'We provide ongoing support and continuous improvement as you grow.'],
];

require __DIR__ . '/includes/header.php';
?>

<main id="main-content" class="markets-page">
    <?php require __DIR__ . '/includes/page-banner.php'; ?>

    <section class="markets-intro section-shell" aria-label="Global market support">
        <div class="markets-intro-copy" data-reveal="left">
            <p class="eyebrow"><span class="eyebrow-line"></span>People. Solutions. Technology. Growth.</p>
            <h2>Global support<br>with <span>local knowledge.</span></h2>
            <p>We provide tailored accountancy, IT and business support services to clients in the UK, Ireland, USA and beyond, helping businesses navigate local regulations, reduce costs and achieve sustainable growth.</p>
            <a class="button button-primary" href="contact">Get a Free Consultation <span class="button-arrow" aria-hidden="true">→</span></a>
        </div>
        <div class="markets-map-frame" data-reveal="right">
            <?php if (is_file(__DIR__ . '/assets/markets/markets.png')): ?>
                <img src="assets/markets/markets.png" alt="Global delivery connections between the United States, United Kingdom, Ireland and Pakistan" width="1672" height="941">
            <?php else: ?>
                <div class="markets-map-placeholder"><span aria-hidden="true">◎</span><b>Global reach.<br>Local expertise.</b></div>
            <?php endif; ?>
            <span class="markets-map-caption"><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg></span> Based in Pakistan. Supporting businesses worldwide.</span>
        </div>
    </section>

    <section class="markets-key section-shell" aria-labelledby="markets-key-title">
        <div class="markets-section-heading" data-reveal="up">
            <p class="eyebrow"><span class="eyebrow-line"></span>Where we work</p>
            <h2 id="markets-key-title">Our <span>Key Markets</span></h2>
            <p>Local insight and dependable support for businesses in every market we serve.</p>
        </div>
        <div class="markets-country-grid">
            <?php foreach ($marketCountries as $country): ?>
                <?php if (!is_file(__DIR__ . '/' . $country['image']) || !is_file(__DIR__ . '/' . $country['flag'])) { continue; } ?>
                <article class="markets-country-card" data-reveal="up">
                    <div class="markets-country-image">
                        <img src="<?= htmlspecialchars($country['image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($country['imageAlt'], ENT_QUOTES, 'UTF-8') ?>" width="720" height="440" loading="lazy">
                        <span class="markets-country-flag">
                            <img src="<?= htmlspecialchars($country['flag'], ENT_QUOTES, 'UTF-8') ?>" alt="" width="48" height="32" loading="lazy">
                        </span>
                    </div>
                    <div class="markets-country-body">
                        <div class="markets-country-title">
                            <span class="markets-country-kicker">A market we know</span>
                            <h3><?= htmlspecialchars($country['name'], ENT_QUOTES, 'UTF-8') ?><span aria-hidden="true">.</span></h3>
                        </div>
                        <p><?= htmlspecialchars($country['description'], ENT_QUOTES, 'UTF-8') ?></p>
                        <div class="markets-services-label"><span></span>Support tailored to your market</div>
                        <ul class="markets-service-list">
                            <?php foreach ($marketServices as $service): ?>
                                <li><span aria-hidden="true">✓</span><?= htmlspecialchars($service, ENT_QUOTES, 'UTF-8') ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="markets-additional" aria-labelledby="markets-additional-title">
        <div class="section-shell">
            <div class="markets-section-heading markets-additional-heading" data-reveal="up">
                <p class="eyebrow"><span class="eyebrow-line"></span>Growing global reach</p>
                <h2 id="markets-additional-title">We Also Support Businesses <span>In</span></h2>
            </div>
            <div class="markets-additional-grid">
                <?php foreach ($additionalMarkets as $market): ?>
                    <article class="markets-additional-card" data-reveal="up">
                        <?php if (is_file(__DIR__ . '/' . $market['flag'])): ?>
                            <img src="<?= htmlspecialchars($market['flag'], ENT_QUOTES, 'UTF-8') ?>" alt="" width="54" height="36" loading="lazy">
                        <?php else: ?>
                            <span class="markets-flag-needed" aria-hidden="true"><?= htmlspecialchars($market['code'], ENT_QUOTES, 'UTF-8') ?></span>
                        <?php endif; ?>
                        <b><?= htmlspecialchars($market['name'], ENT_QUOTES, 'UTF-8') ?></b>
                    </article>
                <?php endforeach; ?>
                <article class="markets-additional-card markets-worldwide-card" data-reveal="up">
                    <span class="markets-worldwide-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 0 1 0 18m0-18a15 15 0 0 0 0 18"/></svg></span>
                    <b>Other International<br>Markets</b>
                </article>
            </div>
        </div>
    </section>

    <section class="markets-advantages" aria-labelledby="markets-advantages-title">
        <div class="markets-advantages-inner section-shell">
            <div class="markets-advantages-copy" data-reveal="left">
                <p class="eyebrow">Why businesses choose us across our markets</p>
                <h2 id="markets-advantages-title">Local Knowledge.<br><span>Global Capabilities.</span></h2>
                <p>We combine local regulatory knowledge with a global delivery model to provide consistent, high-quality services to businesses across multiple markets.</p>
                <a class="button button-primary" href="contact">Discuss Your Market Needs <span class="button-arrow" aria-hidden="true">→</span></a>
            </div>
            <div class="markets-benefit-grid">
                <?php foreach ($marketBenefits as $benefit): ?>
                    <article class="markets-benefit" data-reveal="up">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="<?= htmlspecialchars($benefit['icon'], ENT_QUOTES, 'UTF-8') ?>"/></svg>
                        <b><?= htmlspecialchars($benefit['title'], ENT_QUOTES, 'UTF-8') ?><br><?= htmlspecialchars($benefit['detail'], ENT_QUOTES, 'UTF-8') ?></b>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="markets-approach section-shell" aria-labelledby="markets-approach-title">
        <div class="markets-section-heading" data-reveal="up">
            <p class="eyebrow"><span class="eyebrow-line"></span>How we work</p>
            <h2 id="markets-approach-title">Our <span>Approach</span></h2>
        </div>
        <ol class="markets-approach-list">
            <?php foreach ($marketApproach as $step): ?>
                <li data-reveal="up">
                    <span class="markets-approach-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="<?= htmlspecialchars($step['icon'], ENT_QUOTES, 'UTF-8') ?>"/></svg></span>
                    <span class="markets-approach-copy"><b><?= htmlspecialchars($step['title'], ENT_QUOTES, 'UTF-8') ?></b><span><?= htmlspecialchars($step['text'], ENT_QUOTES, 'UTF-8') ?></span></span>
                </li>
            <?php endforeach; ?>
        </ol>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
