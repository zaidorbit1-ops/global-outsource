<?php
declare(strict_types=1);

http_response_code(404);

$scriptDirectory = str_replace('\\', '/', dirname((string) ($_SERVER['SCRIPT_NAME'] ?? '/')));
$documentBaseHref = rtrim($scriptDirectory, '/') . '/';
$currentPage = 'not-found';
$pageTitle = 'Page Not Found | Global Outsource';
$pageDescription = 'The page you are looking for could not be found. Explore Global Outsource services or contact our team.';

require __DIR__ . '/includes/header.php';
?>

<main id="main-content" class="not-found-page">
    <section class="not-found-card section-shell" aria-labelledby="not-found-title">
        <div class="not-found-copy" data-reveal="left">
            <p class="eyebrow"><span class="eyebrow-line"></span>Wrong turn?</p>
            <p class="not-found-code" aria-hidden="true">404<span>.</span></p>
            <h1 id="not-found-title">This page isn’t <span>here.</span></h1>
            <p class="not-found-description">The link may be outdated, or the page may have moved. Let’s get you back to the right place.</p>
            <div class="not-found-actions">
                <a class="button button-primary" href="./">Back to Home <span class="button-arrow" aria-hidden="true">→</span></a>
                <a class="button button-secondary" href="contact">Contact Us</a>
            </div>
        </div>
        <div class="not-found-art" aria-hidden="true" data-reveal="right">
            <div class="not-found-orbit not-found-orbit-one"></div>
            <div class="not-found-orbit not-found-orbit-two"></div>
            <div class="not-found-globe"><span>?</span></div>
            <span class="not-found-node not-found-node-one">404</span>
            <span class="not-found-node not-found-node-two">PAGE NOT FOUND</span>
            <span class="not-found-spark not-found-spark-one">✳</span>
            <span class="not-found-spark not-found-spark-two">✦</span>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
