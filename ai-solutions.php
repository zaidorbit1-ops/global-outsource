<?php
declare(strict_types=1);

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; script-src 'self'; connect-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'");

$currentPage = 'ai-solutions';
$pageTitle = 'AI Solutions & Automation | Global Outsource';
$pageDescription = 'Practical AI solutions for automation, analytics and smarter business decisions for organizations in the UK, Ireland and USA.';
$breadcrumbItems = [
    ['label' => 'Home', 'url' => 'index'],
    ['label' => 'Services', 'url' => 'index#services'],
    ['label' => 'AI Solutions'],
];
$pageBannerTitle = 'AI';
$pageBannerAccent = 'Solutions';
$pageBannerEyebrow = 'Practical AI solutions to help your business work smarter, faster and more efficiently.';
$pageBannerTagline = 'Turn intelligent technology into measurable business value.';
$pageBannerDescription = 'We help businesses in the UK, Ireland and USA leverage artificial intelligence to automate processes, gain insights and improve decision-making, using secure and scalable solutions tailored to their needs.';
$aiSolutionsImage = 'assets/services/ai-solutions.png';

require __DIR__ . '/includes/header.php';
?>

<main id="main-content" class="service-page ai-solutions-page">
    <?php require __DIR__ . '/includes/page-banner.php'; ?>

    <?php require __DIR__ . '/includes/service-switcher.php'; ?>

    <section class="accounting-intro section-shell" aria-labelledby="ai-intro-title">
        <div class="accounting-intro-copy" data-reveal="left">
            <p class="eyebrow"><span class="eyebrow-line"></span>Our AI Solutions</p>
            <h2 id="ai-intro-title">Turn AI into Real <span>Business Value</span></h2>
            <p>We design and implement AI solutions that automate repetitive tasks, analyse data, improve efficiency and create new opportunities for growth. Our solutions are practical, secure and tailored to the specific needs of your business.</p>
            <a class="button button-primary" href="contact">Get a Free Consultation <span class="button-arrow" aria-hidden="true">→</span></a>
        </div>
        <div class="accounting-intro-image" data-reveal="right">
            <?php if (is_file(__DIR__ . '/' . $aiSolutionsImage)): ?>
                <img src="<?= htmlspecialchars($aiSolutionsImage, ENT_QUOTES, 'UTF-8') ?>" alt="Business professional using AI-powered data and automation tools" width="1000" height="700">
            <?php else: ?>
                <div class="accounting-image-placeholder" role="img" aria-label="Add the AI solutions image at assets/services/ai-solutions.png">
                    <span class="accounting-image-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 3a3 3 0 0 0-3 3v1a3 3 0 0 0-3 3v1a3 3 0 0 0 0 6h1a3 3 0 0 0 6 0V6a3 3 0 0 0-1-2.2M12 3a3 3 0 0 1 3 3v1a3 3 0 0 1 3 3v1a3 3 0 0 1 0 6h-1a3 3 0 0 1-6 0V6a3 3 0 0 1 1-2.2"/></svg></span>
                    <b>AI Solutions</b>
                    <small>Service image · 1000 × 700 px</small>
                </div>
            <?php endif; ?>
        </div>
        <ul class="accounting-benefit-list" data-reveal="right" aria-label="Benefits of our AI solutions">
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-1.7 2.9-.2-.1a1.7 1.7 0 0 0-1.8.2l-.2.1h-3.4l-.1-.2a1.7 1.7 0 0 0-1.8-.2l-.2.1-1.7-2.9.1-.1a1.7 1.7 0 0 0 .3-1.9l-.1-.2v-3.4"/></svg></span><span><b>Increase Efficiency</b><small>Automate routine tasks and reduce manual work.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5"/></svg></span><span><b>Data-Driven Decisions</b><small>Gain valuable insights from your business data.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v14c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 10c0 1.7 3.6 3 8 3s8-1.3 8-3"/></svg></span><span><b>Cost Savings</b><small>Optimise operations and reduce costs.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span><span><b>Secure &amp; Responsible AI</b><small>Implement AI with a focus on security and compliance.</small></span></li>
        </ul>
    </section>

    <section class="accounting-services section-shell" aria-labelledby="key-ai-services">
        <div class="accounting-section-heading" data-reveal="up">
            <p class="eyebrow"><span class="eyebrow-line"></span>Intelligence built around your goals</p>
            <h2 id="key-ai-services">Key AI Services</h2>
            <p>Practical applications of AI to help your team work smarter and achieve more.</p>
        </div>
        <div class="accounting-service-grid">
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="5" y="7" width="14" height="12" rx="3"/><path d="M12 3v4M9 12h.01M15 12h.01M9 16h6M2 11v4m20-4v4M8 21h8"/></svg></span>
                <h3>Process Automation</h3>
                <p>Automate repetitive tasks such as data entry, document processing and workflow management.</p>
                <a href="contact" aria-label="Ask us about process automation">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5"/></svg></span>
                <h3>Data Analytics &amp; Insights</h3>
                <p>Use AI to analyse your data and provide actionable insights to support better business decisions.</p>
                <a href="contact" aria-label="Ask us about data analytics and insights">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M21 11.5a8.4 8.4 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 0 1-.9-3.8A8.5 8.5 0 0 1 8.7 3.9a8.4 8.4 0 0 1 3.8-.9h.5a8.5 8.5 0 0 1 8 8z"/><path d="M8 12h.01M12 12h.01M16 12h.01"/></svg></span>
                <h3>AI Chatbots &amp; Virtual Assistants</h3>
                <p>Implement intelligent chatbots and virtual assistants to improve customer service and internal support.</p>
                <a href="contact" aria-label="Ask us about AI chatbots and virtual assistants">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6 3h9l4 4v14H6z"/><path d="M14 3v5h5M9 13h7m-7 4h5"/></svg></span>
                <h3>Document Processing &amp; OCR</h3>
                <p>Automatically extract and process data from invoices, receipts, contracts and other documents.</p>
                <a href="contact" aria-label="Ask us about document processing and OCR">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 3a3 3 0 0 0-3 3v1a3 3 0 0 0-3 3v1a3 3 0 0 0 0 6h1a3 3 0 0 0 6 0V6a3 3 0 0 0-1-2.2M12 3a3 3 0 0 1 3 3v1a3 3 0 0 1 3 3v1a3 3 0 0 1 0 6h-1a3 3 0 0 1-6 0V6a3 3 0 0 1 1-2.2"/></svg></span>
                <h3>Custom AI Solutions</h3>
                <p>Tailored AI solutions to meet your specific business requirements and integrate with existing systems.</p>
                <a href="contact" aria-label="Ask us about custom AI solutions">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5M5 5h5M5 9h3"/></svg></span>
                <h3>Predictive Analytics</h3>
                <p>Forecast trends, identify opportunities and manage risks using advanced analytics and machine learning.</p>
                <a href="contact" aria-label="Ask us about predictive analytics">↗</a>
            </article>
        </div>
    </section>

    <section class="finance-value-band" aria-labelledby="ai-value-title">
        <div class="finance-value-inner section-shell" data-reveal="up">
            <div class="finance-value-copy">
                <p class="eyebrow"><span class="eyebrow-line"></span>Why choose our AI solutions</p>
                <h2 id="ai-value-title">Practical AI Solutions for <span>Real Business Impact</span></h2>
                <p>We combine technical expertise with a deep understanding of business needs to deliver AI solutions that are practical, secure and focused on measurable results.</p>
                <a class="button button-primary" href="contact">Talk to Our Team <span class="button-arrow" aria-hidden="true">→</span></a>
            </div>
            <div class="finance-value-points it-value-points">
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-1.7 2.9-.2-.1a1.7 1.7 0 0 0-1.8.2l-.2.1h-3.4l-.1-.2a1.7 1.7 0 0 0-1.8-.2l-.2.1-1.7-2.9"/></svg></span><b>Experienced<br>AI Professionals</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v14c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 10c0 1.7 3.6 3 8 3s8-1.3 8-3"/></svg></span><b>Business-Focused<br>Solutions</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span><b>Secure &amp; Compliant<br>Implementation</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span><b>Tailored to<br>Your Needs</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7 18a4 4 0 1 1 .8-7.9A5.5 5.5 0 0 1 18 9a4.5 4.5 0 1 1 0 9Z"/><path d="M12 12v8"/></svg></span><b>Integration with<br>Existing Systems</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 13v-2a8 8 0 0 1 16 0v2"/><path d="M4 13H2v5h4v-5zm16 0h2v5h-4v-5zM6 18a6 6 0 0 0 6 4h2"/></svg></span><b>Ongoing Support<br>&amp; Training</b></article>
            </div>
        </div>
    </section>

        <?php require __DIR__ . '/includes/process-section.php'; ?>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
