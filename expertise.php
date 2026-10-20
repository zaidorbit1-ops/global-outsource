<?php
declare(strict_types=1);

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; script-src 'self'; connect-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'");

$currentPage = 'expertise';
$pageTitle = 'Our Expertise | Global Outsource';
$pageDescription = 'Discover Global Outsource expertise across accounting and finance, IT, AI, software development and industry-focused business solutions.';
$breadcrumbItems = [
    ['label' => 'Home', 'url' => 'index'],
    ['label' => 'Our Expertise'],
];
$pageBannerTitle = 'Our';
$pageBannerAccent = 'Expertise';
$pageBannerEyebrow = 'People, technology and industry knowledge working together.';
$pageBannerTagline = 'Combining expertise to deliver real business value.';
$pageBannerDescription = 'We provide tailored outsourcing and technology solutions to help businesses in the UK, Ireland and USA reduce costs, improve efficiency and achieve sustainable growth.';
$coreExpertise = [
    [
        'title' => 'Accountancy & Finance Outsourcing',
        'description' => 'Bookkeeping, management accounts, financial reporting and outsourced CFO services.',
        'image' => 'assets/services/accounting-finance.png',
        'alt' => 'Accounting and finance services including bookkeeping and financial reporting',
        'url' => 'accounting-finance',
        'icon' => '<path d="M4 20V9m5 11V5m5 15v-8m5 8V3M2 21h20"/><path d="m3 7 5-4 5 3 7-5"/>',
    ],
    [
        'title' => 'IT Solutions',
        'description' => 'Managed IT services, cloud infrastructure, cybersecurity and technical support.',
        'image' => 'assets/services/it-solutions.png',
        'alt' => 'Business IT solutions and technology support',
        'url' => 'it-solutions',
        'icon' => '<rect x="3" y="4" width="18" height="13" rx="2"/><path d="M8 21h8m-4-4v4m-5-9 2 2 4-4"/>',
    ],
    [
        'title' => 'AI Solutions',
        'description' => 'Automation, data analytics and intelligent solutions to drive business efficiency.',
        'image' => 'assets/services/ai-solutions.png',
        'alt' => 'AI solutions for business automation and data analytics',
        'url' => 'ai-solutions',
        'icon' => '<path d="M12 3a3 3 0 0 0-3 3v1a3 3 0 0 0-3 3v1a3 3 0 0 0 0 6h1a3 3 0 0 0 6 0V6a3 3 0 0 0-1-2.2M12 3a3 3 0 0 1 3 3v1a3 3 0 0 1 3 3v1a3 3 0 0 1 0 6h-1a3 3 0 0 1-6 0V6a3 3 0 0 1 1-2.2"/>',
    ],
    [
        'title' => 'Software Development',
        'description' => 'Custom software, web and mobile applications tailored to your business needs.',
        'image' => 'assets/services/software-development.png',
        'alt' => 'Software development for custom digital products',
        'url' => 'software-development',
        'icon' => '<path d="m8 8-4 4 4 4m8-8 4 4-4 4m-3-9-2 10"/>',
    ],
    [
        'title' => 'Managed IT Services',
        'description' => 'Proactive monitoring, maintenance and expert support to keep business systems reliable.',
        'image' => 'assets/services/managed-it-services.png',
        'alt' => 'Managed IT services and proactive technology support',
        'url' => 'managed-it-services',
        'icon' => '<rect x="3" y="4" width="18" height="13" rx="2"/><path d="M8 21h8m-4-4v4m-5-9 2 2 4-4"/>',
    ],
    [
        'title' => 'Cloud Solutions',
        'description' => 'Secure cloud migration, infrastructure management, backup and optimisation.',
        'image' => 'assets/services/cloud-solutions.png',
        'alt' => 'Cloud solutions for secure infrastructure and business continuity',
        'url' => 'cloud-solutions',
        'icon' => '<path d="M7 18a4 4 0 1 1 .8-7.9A5.5 5.5 0 0 1 18 9a4.5 4.5 0 1 1 0 9Z"/><path d="M12 12v8m-3-3 3 3 3-3"/>',
    ],
    [
        'title' => 'Business Process Support',
        'description' => 'Scalable back-office, customer support and process management services.',
        'image' => 'assets/services/business-process-support.png',
        'alt' => 'Business process support and workflow management',
        'url' => 'business-process-support',
        'icon' => '<path d="M4 4h16v16H4z"/><path d="M8 8h8m-8 4h8m-8 4h5"/>',
    ],
];

$industryExpertise = [
    ['title' => 'Healthcare', 'description' => 'GP practices, dental clinics and care homes.', 'image' => 'assets/expertise/healthcare.jpg', 'alt' => 'Healthcare professionals supporting patients', 'icon' => '<path d="M20.8 8.5c0 5.5-8.8 11-8.8 11s-8.8-5.5-8.8-11A4.8 4.8 0 0 1 12 6.2a4.8 4.8 0 0 1 8.8 2.3Z"/><path d="M8 11h2l1.2-2.5 2.1 5 1.2-2.5H17"/>'],
    ['title' => 'Retail & E-commerce', 'description' => 'Online stores, retail chains and marketplaces.', 'image' => 'assets/expertise/retail-ecommerce.jpg', 'alt' => 'Retail and e-commerce business', 'icon' => '<path d="M3 3h2l2.4 12.1a2 2 0 0 0 2 1.6h8.8a2 2 0 0 0 2-1.6L22 8H6"/><circle cx="10" cy="21" r="1"/><circle cx="18" cy="21" r="1"/>'],
    ['title' => 'Professional Services', 'description' => 'Accountancy firms, law firms and consultants.', 'image' => 'assets/expertise/professional-services.jpg', 'alt' => 'Professional services team collaborating', 'icon' => '<rect x="3" y="7" width="18" height="14" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 12h18m-11 0v2h4v-2"/>'],
    ['title' => 'Manufacturing', 'description' => 'Production, distribution and supply chain.', 'image' => 'assets/expertise/manufacturing.jpg', 'alt' => 'Modern manufacturing and production', 'icon' => '<path d="M3 21V9l6 4V9l6 4V5l6 4v12z"/><path d="M7 17h2m3 0h2m3 0h2M7 7V3h5v7"/>'],
    ['title' => 'Property & Construction', 'description' => 'Developers, contractors and property management.', 'image' => 'assets/expertise/property-construction.jpg', 'alt' => 'Property development and construction', 'icon' => '<path d="M3 10.5 12 3l9 7.5V21h-6v-6H9v6H3z"/><path d="M6.5 11h.01M17.5 11h.01"/>'],
];

require __DIR__ . '/includes/header.php';
?>

<main id="main-content" class="expertise-page">
    <?php require __DIR__ . '/includes/page-banner.php'; ?>

    <section class="expertise-core section-shell" aria-labelledby="core-expertise-title">
        <div class="accounting-section-heading" data-reveal="up">
            <p class="eyebrow"><span class="eyebrow-line"></span>What we do best</p>
            <h2 id="core-expertise-title">Our Core Areas of Expertise</h2>
        </div>
        <div class="expertise-core-grid">
            <?php foreach ($coreExpertise as $expertise): ?>
                <a class="expertise-core-card" href="<?= htmlspecialchars($expertise['url'], ENT_QUOTES, 'UTF-8') ?>" data-reveal="up">
                    <span class="expertise-core-image">
                        <img src="<?= htmlspecialchars($expertise['image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($expertise['alt'], ENT_QUOTES, 'UTF-8') ?>" width="700" height="420" loading="lazy">
                    </span>
                    <span class="expertise-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><?= $expertise['icon'] ?></svg></span>
                    <span class="expertise-core-copy"><b><?= htmlspecialchars($expertise['title'], ENT_QUOTES, 'UTF-8') ?></b><span><?= htmlspecialchars($expertise['description'], ENT_QUOTES, 'UTF-8') ?></span></span>
                    <span class="expertise-card-arrow" aria-hidden="true">›</span>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="expertise-industries section-shell" aria-labelledby="industry-expertise-title">
        <div class="expertise-industries-heading" data-reveal="up">
            <div class="accounting-section-heading">
                <p class="eyebrow"><span class="eyebrow-line"></span>Industry expertise</p>
                <h2 id="industry-expertise-title">Solutions shaped around your industry</h2>
                <p>We work with businesses across a wide range of industries, bringing specialist knowledge and tailored solutions to meet sector-specific needs.</p>
            </div>
            <a class="button button-primary" href="contact">Discuss Your Industry Needs <span class="button-arrow" aria-hidden="true">→</span></a>
        </div>
        <div class="expertise-industry-grid">
            <?php foreach ($industryExpertise as $industry): ?>
                <article class="expertise-industry-card" data-reveal="up">
                    <div class="expertise-industry-visual">
                        <?php if (is_file(__DIR__ . '/' . $industry['image'])): ?>
                            <img class="expertise-industry-image" src="<?= htmlspecialchars($industry['image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($industry['alt'], ENT_QUOTES, 'UTF-8') ?>" width="720" height="405" loading="lazy">
                        <?php else: ?>
                            <span class="expertise-industry-image-placeholder">Add <?= htmlspecialchars(basename($industry['image']), ENT_QUOTES, 'UTF-8') ?><br>720 × 405 px</span>
                        <?php endif; ?>
                    </div>
                    <span class="expertise-industry-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><?= $industry['icon'] ?></svg></span>
                    <h3><?= htmlspecialchars($industry['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p><?= htmlspecialchars($industry['description'], ENT_QUOTES, 'UTF-8') ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="expertise-why section-shell" aria-labelledby="why-expertise-title">
        <div class="accounting-section-heading" data-reveal="up">
            <p class="eyebrow"><span class="eyebrow-line"></span>Built around your business</p>
            <h2 id="why-expertise-title">Why Businesses Choose Our Expertise</h2>
        </div>
        <div class="expertise-reasons">
            <article data-reveal="up"><span aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span><div><h3>Experienced Professionals</h3><p>A dedicated team with international exposure and domain expertise.</p></div></article>
            <article data-reveal="up"><span aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-1.7 2.9-.2-.1a1.7 1.7 0 0 0-1.8.2l-.2.1h-3.4l-.1-.2a1.7 1.7 0 0 0-1.8-.2l-.2.1-1.7-2.9.1-.1a1.7 1.7 0 0 0 .3-1.9l-.1-.2v-3.4"/></svg></span><div><h3>Tailored Solutions</h3><p>Customised services to meet your specific business requirements.</p></div></article>
            <article data-reveal="up"><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span><div><h3>Secure &amp; Compliant</h3><p>Adhering to global best practices and regulatory standards.</p></div></article>
            <article data-reveal="up"><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5"/></svg></span><div><h3>Focus on Results</h3><p>Delivering measurable improvements in efficiency, costs and growth.</p></div></article>
        </div>
    </section>

    <section class="expertise-stats" aria-label="Global Outsource at a glance">
        <div class="expertise-stats-inner section-shell">
            <article data-reveal="up"><span class="expertise-stat-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span><b>100<span>+</span></b><small>Clients Worldwide</small></article>
            <article data-reveal="up"><span class="expertise-stat-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6 3h9l4 4v14H6z"/><path d="M14 3v5h5M9 13h7m-7 4h7"/></svg></span><b>15<span>+</span></b><small>Years of Experience</small></article>
            <article data-reveal="up"><span class="expertise-stat-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 0 1 0 18m0-18a15 15 0 0 0 0 18"/></svg></span><b>3</b><small>Key Markets<br>UK, Ireland &amp; USA</small></article>
            <article data-reveal="up"><span class="expertise-stat-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M8 21h8m-4-4v4M5 4h14l-1 9a6 6 0 0 1-12 0z"/><path d="M5 7H3v3a4 4 0 0 0 4 4m12-7h2v3a4 4 0 0 1-4 4"/></svg></span><b>99<span>%</span></b><small>Client Satisfaction</small></article>
        </div>
    </section>

    <section class="expertise-approach section-shell" aria-labelledby="expertise-approach-title">
        <div class="accounting-section-heading" data-reveal="up">
            <p class="eyebrow"><span class="eyebrow-line"></span>How we work</p>
            <h2 id="expertise-approach-title">Our Approach</h2>
        </div>
        <ol class="finance-process-list">
            <li data-reveal="up"><span class="process-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="10.5" cy="10.5" r="6.5"/><path d="m16 16 5 5"/></svg></span><div class="process-copy"><h3>Understand</h3><p>We analyse your business needs, challenges and goals.</p></div></li>
            <li data-reveal="up"><span class="process-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6 3h9l4 4v14H6z"/><path d="M14 3v5h5M9 13h7m-7 4h7"/></svg></span><div class="process-copy"><h3>Plan</h3><p>We design a tailored solution with clear objectives.</p></div></li>
            <li data-reveal="up"><span class="process-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-1.7 2.9-.2-.1a1.7 1.7 0 0 0-1.8.2l-.2.1h-3.4"/></svg></span><div class="process-copy"><h3>Implement</h3><p>Our experts deliver and integrate the solution efficiently.</p></div></li>
            <li data-reveal="up"><span class="process-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 13v-2a8 8 0 0 1 16 0v2"/><path d="M4 13H2v5h4v-5zm16 0h2v5h-4v-5zM6 18a6 6 0 0 0 6 4h2"/></svg></span><div class="process-copy"><h3>Support</h3><p>We provide ongoing support and continuous improvement.</p></div></li>
        </ol>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
