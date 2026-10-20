<?php
$ctaTitle = 'Ready to Work with a Trusted Outsourcing Partner?';
$ctaDescription = "Let's discuss how we can support your business with accountancy, IT, AI and software development solutions.";
$ctaButtonHref = 'contact';
?>
<section class="cta-section" id="contact" aria-labelledby="cta-title" data-reveal="up">
    <div class="cta-inner section-shell">
        <div class="cta-copy">
            <h2 id="cta-title"><?= htmlspecialchars($ctaTitle, ENT_QUOTES, 'UTF-8') ?></h2>
            <p><?= htmlspecialchars($ctaDescription, ENT_QUOTES, 'UTF-8') ?></p>
            <div class="cta-actions">
                <a class="button cta-button" href="<?= htmlspecialchars($ctaButtonHref, ENT_QUOTES, 'UTF-8') ?>">Get a Free Consultation <span class="button-arrow" aria-hidden="true">→</span></a>
            </div>
        </div>
    </div>
</section>
