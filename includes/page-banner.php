<?php
declare(strict_types=1);

$pageBannerTitle = $pageBannerTitle ?? '';
$pageBannerAccent = $pageBannerAccent ?? '';
$pageBannerEyebrow = $pageBannerEyebrow ?? '';
$pageBannerTagline = $pageBannerTagline ?? '';
$pageBannerDescription = $pageBannerDescription ?? '';
$breadcrumbClass = 'breadcrumb page-banner-breadcrumb';
?>
<section class="page-banner section-shell" aria-labelledby="page-banner-title">
    <?php require __DIR__ . '/breadcrumb.php'; ?>
    <div class="page-banner-copy" data-reveal="up">
        <?php if ($pageBannerEyebrow !== ''): ?>
            <p class="eyebrow"><span class="eyebrow-line"></span><?= htmlspecialchars($pageBannerEyebrow, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
        <h1 id="page-banner-title">
            <?= htmlspecialchars($pageBannerTitle, ENT_QUOTES, 'UTF-8') ?>
            <?php if ($pageBannerAccent !== ''): ?>
                <span><?= htmlspecialchars($pageBannerAccent, ENT_QUOTES, 'UTF-8') ?></span>
            <?php endif; ?>
        </h1>
        <?php if ($pageBannerTagline !== ''): ?>
            <p class="page-banner-tagline"><?= htmlspecialchars($pageBannerTagline, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
        <?php if ($pageBannerDescription !== ''): ?>
            <p class="page-banner-description"><?= htmlspecialchars($pageBannerDescription, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
        </div>
</section>
