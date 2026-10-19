<?php
$ctaEyebrow = $ctaEyebrow ?? 'Your next step starts here';
$ctaTitleFirstLine = $ctaTitleFirstLine ?? 'Ready to grow?';
$ctaTitleSecondLine = $ctaTitleSecondLine ?? "Let's make it happen.";
$ctaDescription = $ctaDescription ?? 'Tell us what you want to achieve. Our team will help you find the right people, technology and support to move forward.';
$ctaButtonLabel = $ctaButtonLabel ?? 'Start a Conversation';
$ctaButtonHref = $ctaButtonHref ?? 'contact';
$ctaShowEmail = $ctaShowEmail ?? true;
?>
<section class="cta-section" id="contact" aria-labelledby="cta-title" data-reveal="up">
    <div class="cta-inner section-shell">
        <div class="cta-copy">
            <p class="cta-eyebrow"><span></span><?= htmlspecialchars($ctaEyebrow, ENT_QUOTES, 'UTF-8') ?><span></span></p>
            <h2 id="cta-title"><span class="cta-title-line"><?= htmlspecialchars($ctaTitleFirstLine, ENT_QUOTES, 'UTF-8') ?></span><span class="cta-title-line"><?= htmlspecialchars($ctaTitleSecondLine, ENT_QUOTES, 'UTF-8') ?></span></h2>
            <p><?= htmlspecialchars($ctaDescription, ENT_QUOTES, 'UTF-8') ?></p>
            <div class="cta-actions">
                <a class="button button-light" href="<?= htmlspecialchars($ctaButtonHref, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($ctaButtonLabel, ENT_QUOTES, 'UTF-8') ?> <span class="button-arrow" aria-hidden="true">→</span></a>
                <?php if ($ctaShowEmail): ?>
                    <a class="cta-email" href="mailto:info@globaloutsource.com"><span aria-hidden="true">✉</span> info@globaloutsource.com</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
