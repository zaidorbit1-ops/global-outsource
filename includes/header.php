<?php
declare(strict_types=1);
$currentPage = $currentPage ?? 'home';
$pageTitle = $pageTitle ?? 'Global Outsource | Your Trusted Outsourcing Partner';
$pageDescription = $pageDescription ?? 'Global Outsource provides accountancy, IT, AI and software development services to businesses in the UK, Ireland and USA.';
$isHomePage = $currentPage === 'home';
$homePrefix = $isHomePage ? '' : './';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#17191d">
    <meta name="description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <?php if (!empty($documentBaseHref)): ?>
        <base href="<?= htmlspecialchars($documentBaseHref, ENT_QUOTES, 'UTF-8') ?>">
    <?php endif; ?>
    <link rel="icon" href="assets/favicon/favicon.ico" sizes="any">
    <link rel="icon" href="assets/favicon/favicon.svg" type="image/svg+xml">
    <link rel="icon" href="assets/favicon/favicon-96x96.png" type="image/png" sizes="96x96">
    <link rel="apple-touch-icon" href="assets/favicon/apple-touch-icon.png">
    <link rel="manifest" href="assets/favicon/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/main.js" defer></script>
</head>
<body>
<a class="skip-link" href="#main-content">Skip to content</a>
<header class="site-header">
    <div class="topbar">
        <div class="topbar-inner section-shell">
            <p class="topbar-location"><span class="location-mark" aria-hidden="true">◉</span> Based in Pakistan <i></i> Supporting Clients in the UK, Ireland &amp; USA</p>
            <div class="topbar-links">
                <a href="mailto:info@globaloutsource.com"><span class="top-icon" aria-hidden="true">✉</span>info@globaloutsource.com</a>
                <a href="tel:+923001234567"><span class="top-icon" aria-hidden="true">☎</span>+92 300 1234567</a>
                <span class="top-divider"></span>
                <span class="social-link" aria-hidden="true">in</span><span class="social-link" aria-hidden="true">f</span><span class="social-link social-play" aria-hidden="true">▶</span>
                <a class="top-search" href="<?= htmlspecialchars($homePrefix, ENT_QUOTES, 'UTF-8') ?>#services" aria-label="Explore our services"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.3"/><path d="m16 16 4.5 4.5"/></svg></a>
            </div>
        </div>
    </div>
    <div class="nav-wrap">
        <div class="nav-inner section-shell">
            <a class="brand" href="index" aria-label="Global Outsource home"><img src="logo.png" alt="Global Outsource" width="250" height="88"></a>
            <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation" aria-label="Open navigation menu"><span></span><span></span><span></span></button>
            <nav class="primary-nav" id="primary-navigation" aria-label="Main navigation">
                <a class="nav-link<?= $isHomePage ? ' is-active' : '' ?>" href="<?= htmlspecialchars($homePrefix, ENT_QUOTES, 'UTF-8') ?>#home"<?= $isHomePage ? ' aria-current="page"' : '' ?>>Home</a>
                <a class="nav-link<?= $currentPage === 'about' ? ' is-active' : '' ?>" href="about"<?= $currentPage === 'about' ? ' aria-current="page"' : '' ?>>About Us</a>
                <div class="nav-dropdown">
                    <button class="nav-link dropdown-trigger<?= in_array($currentPage, ['accounting-finance', 'it-solutions', 'ai-solutions', 'software-development', 'managed-it-services', 'cloud-solutions', 'business-process-support'], true) ? ' is-active' : '' ?>" type="button" aria-expanded="false"<?= in_array($currentPage, ['accounting-finance', 'it-solutions', 'ai-solutions', 'software-development', 'managed-it-services', 'cloud-solutions', 'business-process-support'], true) ? ' aria-current="page"' : '' ?>>Services <span class="chevron" aria-hidden="true"></span></button>
                    <div class="dropdown-menu">
                        <a href="accounting-finance">Accountancy &amp; Finance</a><a href="it-solutions">IT Solutions</a><a href="ai-solutions">AI Solutions</a><a href="software-development">Software Development</a><a href="managed-it-services">Managed IT Services</a><a href="cloud-solutions">Cloud Solutions</a><a href="business-process-support">Business Process Support</a>
                    </div>
                </div>
                <a class="nav-link<?= $currentPage === 'expertise' ? ' is-active' : '' ?>" href="expertise"<?= $currentPage === 'expertise' ? ' aria-current="page"' : '' ?>>Our Expertise</a>
                <a class="nav-link<?= $currentPage === 'markets' ? ' is-active' : '' ?>" href="markets"<?= $currentPage === 'markets' ? ' aria-current="page"' : '' ?>>Markets</a>
                <a class="nav-link<?= $currentPage === 'careers' ? ' is-active' : '' ?>" href="careers"<?= $currentPage === 'careers' ? ' aria-current="page"' : '' ?>>Careers</a>
                <a class="nav-link<?= $currentPage === 'contact' ? ' is-active' : '' ?>" href="contact"<?= $currentPage === 'contact' ? ' aria-current="page"' : '' ?>>Contact</a>
            </nav>
            <a class="button button-primary nav-cta" href="contact">Get a Free Consultation <span class="button-arrow" aria-hidden="true">→</span></a>
        </div>
    </div>
</header>
