<?php
declare(strict_types=1);

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; script-src 'self'; connect-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'");

$currentPage = 'accounting-finance';
$pageTitle = 'Accounting & Finance Outsourcing | Global Outsource';
$pageDescription = 'Reliable, accurate accounting and finance outsourcing for growing businesses in the UK, Ireland and USA.';
$breadcrumbItems = [
    ['label' => 'Home', 'url' => 'index'],
    ['label' => 'Services', 'url' => 'index#services'],
    ['label' => 'Accounting & Finance Outsourcing'],
];
$pageBannerTitle = 'Accounting & Finance';
$pageBannerAccent = 'Outsourcing';
$pageBannerEyebrow = 'Reliable finance support. Confidence in every number.';
$pageBannerTagline = 'Accurate. Efficient. Built around your business.';
$pageBannerDescription = 'We provide end-to-end accounting and finance outsourcing to help businesses streamline operations, reduce costs and focus on growth.';
$accountingImage = 'assets/services/accounting-finance.png';

require __DIR__ . '/includes/header.php';
?>

<main id="main-content" class="service-page accounting-page">
    <?php require __DIR__ . '/includes/page-banner.php'; ?>

    <?php require __DIR__ . '/includes/service-switcher.php'; ?>

    <section class="accounting-intro section-shell" aria-labelledby="accounting-intro-title">
        <div class="accounting-intro-copy" data-reveal="left">
            <p class="eyebrow"><span class="eyebrow-line"></span>Accounting &amp; Finance Outsourcing</p>
            <h2 id="accounting-intro-title">Our Accounting &amp; Finance<br>Outsourcing <span>Services</span></h2>
            <p>We provide comprehensive accountancy and finance support tailored to the needs of businesses in the UK, Ireland and USA. Our experienced team works as an extension of your business, using the latest technology and best practices to deliver accurate, timely and reliable financial information.</p>
            <a class="button button-primary" href="contact">Talk to Our Team <span class="button-arrow" aria-hidden="true">→</span></a>
        </div>
        <div class="accounting-intro-image" data-reveal="right">
            <?php if (is_file(__DIR__ . '/' . $accountingImage)): ?>
                <img src="<?= htmlspecialchars($accountingImage, ENT_QUOTES, 'UTF-8') ?>" alt="Illustration of Global Outsource accounting and finance services, bookkeeping and financial reporting" width="1000" height="700">
            <?php else: ?>
                <div class="accounting-image-placeholder" role="img" aria-label="Add the accounting and finance services image at assets/services/accounting-finance.png">
                    <span class="accounting-image-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><path d="M4 20V9m5 11V5m5 15v-8m5 8V3M2 21h20"/><path d="m3 7 5-4 5 3 7-5"/></svg>
                    </span>
                    <b>Accounting &amp; Finance</b>
                    <small>Service image · 1000 × 700 px</small>
                </div>
            <?php endif; ?>
        </div>
        <ul class="accounting-benefit-list" data-reveal="right" aria-label="Benefits of our finance outsourcing">
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v5c0 1.7 3.6 3 8 3 1.2 0 2.3-.1 3.3-.3M4 10v5c0 1.7 3.6 3 8 3m-8-8c0 1.2 1.8 2.2 4.5 2.7M18 13v8m-4-4h8"/></svg></span><span><b>Reduce Costs</b><small>Lower operational costs with flexible support.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 2v3m0 14v3M4.9 4.9 7 7m10 10 2.1 2.1M2 12h3m14 0h3M4.9 19.1 7 17m10-10 2.1-2.1"/><circle cx="12" cy="12" r="6"/></svg></span><span><b>Improve Efficiency</b><small>Streamline your finance processes.</small></span></li>
            <li><span class="accounting-benefit-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5"/></svg></span><span><b>Focus on Growth</b><small>Get clear insights to make better decisions.</small></span></li>
        </ul>
    </section>

    <section class="accounting-services section-shell" aria-labelledby="key-accounting-services">
        <div class="accounting-section-heading" data-reveal="up">
            <p class="eyebrow"><span class="eyebrow-line"></span>Practical support, accurate results</p>
            <h2 id="key-accounting-services">Key Accounting &amp; Finance Services</h2>
            <p>Flexible support across the finance tasks that keep your business moving.</p>
        </div>
        <div class="accounting-service-grid">
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6 3h9l4 4v14H6z"/><path d="M14 3v5h5M9 13h7m-7 4h7"/></svg></span>
                <h3>Bookkeeping &amp;<br>Accounts Preparation</h3>
                <p>Daily, weekly or monthly bookkeeping and preparation of management accounts.</p>
                <a href="contact" aria-label="Ask us about bookkeeping and accounts preparation">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5"/></svg></span>
                <h3>Management Accounts<br>&amp; Reporting</h3>
                <p>Regular management accounts with meaningful financial insights.</p>
                <a href="contact" aria-label="Ask us about management accounts and reporting">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="6" width="18" height="14" rx="2"/><path d="M8 6V4h8v2m-13 5h18m-11 4h4"/></svg></span>
                <h3>Payroll Processing</h3>
                <p>End-to-end payroll support, including payslips, reports and submissions.</p>
                <a href="contact" aria-label="Ask us about payroll processing">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6 3h9l4 4v14H6z"/><path d="M14 3v5h5M9 13h7m-7 4h4"/></svg></span>
                <h3>Accounts Receivable<br>&amp; Payable</h3>
                <p>Management of invoices, payments and reconciliations.</p>
                <a href="contact" aria-label="Ask us about accounts receivable and payable">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon accounting-percent-icon" aria-hidden="true">%</span>
                <h3>Tax Support</h3>
                <p>Support with VAT, PAYE, corporation tax and other tax compliance.</p>
                <a href="contact" aria-label="Ask us about tax support">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18m-13 4h2m4 0h2m-8 3h2m4 0h2"/></svg></span>
                <h3>Year-End Support</h3>
                <p>Assistance with year-end accounts and tax return preparation.</p>
                <a href="contact" aria-label="Ask us about year-end support">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 4v16M4 12h16"/><path d="M5.5 5.5a9.2 9.2 0 0 1 13 0m-13 13a9.2 9.2 0 0 0 13 0"/></svg></span>
                <h3>Cloud Accounting</h3>
                <p>Expertise in Xero, QuickBooks, Sage and other cloud accounting platforms.</p>
                <a href="contact" aria-label="Ask us about cloud accounting">↗</a>
            </article>
            <article class="accounting-service-card" data-reveal="up">
                <span class="accounting-card-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 20V9m5 11V5m5 15v-8m5 8V3M2 21h20"/></svg></span>
                <h3>Financial Analysis</h3>
                <p>Analysis and reporting to help you make informed business decisions.</p>
                <a href="contact" aria-label="Ask us about financial analysis">↗</a>
            </article>
        </div>
    </section>

    <section class="finance-value-band" aria-labelledby="finance-value-title">
        <div class="finance-value-inner section-shell">
            <div class="finance-value-copy" data-reveal="left">
                <p class="eyebrow"><span class="eyebrow-line"></span>A stronger finance function</p>
                <h2 id="finance-value-title">Why Outsource Your<br><span>Finance Function?</span></h2>
                <p>Partnering with Global Outsource gives you access to a skilled and dedicated finance team, modern technology and international best practices.</p>
                <a class="button button-primary" href="contact">Talk to Our Team <span class="button-arrow" aria-hidden="true">→</span></a>
            </div>
            <div class="finance-value-points" data-reveal="right">
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 2v20m7-16H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H5"/></svg></span><b>Cost<br>Savings</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1m3-9a3 3 0 1 0-1-5.8M18 14a5 5 0 0 1 3 4.6v1"/></svg></span><b>Skilled<br>Professionals</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 2v3m0 14v3M4.9 4.9 7 7m10 10 2.1 2.1M2 12h3m14 0h3M4.9 19.1 7 17m10-10 2.1-2.1"/><circle cx="12" cy="12" r="6"/></svg></span><b>Scalable<br>Support</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></span><b>Accuracy &amp;<br>Compliance</b></article>
                <article><span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 20h18M5 17l5-5 4 3 6-8"/><path d="M15 7h5v5"/></svg></span><b>Focus on<br>Core Business</b></article>
            </div>
        </div>
    </section>

    <?php require __DIR__ . '/includes/process-section.php'; ?>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
