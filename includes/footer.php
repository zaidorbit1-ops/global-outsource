<?php
$footerMarketImage = 'assets/markets/focus-markets.png';
?>
<?php if (empty($hideFooterCta)) { require __DIR__ . '/call-to-action.php'; } ?>
<footer class="site-footer" id="site-footer">
    <div class="footer-main section-shell">
        <div class="footer-brand-column">
            <a class="footer-brand" href="index" aria-label="Global Outsource home"><img src="logo.png" alt="Global Outsource" width="250" height="88"></a>
            <p>We provide Accountancy and IT Solutions, AI and Software Development services to clients in the UK, Ireland and USA. Helping businesses reduce costs, increase efficiency and achieve sustainable growth.</p>
            <div class="footer-social" aria-hidden="true"><span>in</span><span>f</span><span>▶</span><span>◉</span></div>
            <p class="footer-script">People. Technology. Global Opportunities.</p>
        </div>
        <div class="footer-column">
            <h2>Our Services</h2><ul><li><a href="accounting-finance">Accountancy &amp; Finance Outsourcing</a></li><li><a href="it-solutions">IT Solutions</a></li><li><a href="ai-solutions">AI Solutions</a></li><li><a href="software-development">Software Development</a></li><li><a href="managed-it-services">Managed IT Services</a></li><li><a href="cloud-solutions">Cloud Solutions</a></li><li><a href="business-process-support">Business Process Support</a></li></ul>
        </div>
        <div class="footer-column">
            <h2>Company</h2><ul><li><a href="about">About Us</a></li><li><a href="expertise">Our Expertise</a></li><li><a href="markets">Markets We Serve</a></li><li><a href="careers">Careers</a></li><li><a href="contact">Contact Us</a></li></ul>
        </div>
        <div class="footer-column footer-contact">
            <h2>Contact Information</h2>
            <p><span class="footer-icon" aria-hidden="true">⌖</span><span>Karachi, Pakistan</span></p>
            <a href="mailto:info@globaloutsource.com"><span class="footer-icon" aria-hidden="true">✉</span>info@globaloutsource.com</a>
            <a href="tel:+923001234567"><span class="footer-icon" aria-hidden="true">☎</span>+92 300 1234567</a>
            <p><span class="footer-icon" aria-hidden="true">◷</span><span>Mon - Fri: 9:00 AM - 6:00 PM<br>(PKT)</span></p>
        </div>
        <div class="footer-column footer-markets">
            <h2>Our Focus Markets</h2>
            <div class="footer-map">
                <?php if (is_file(__DIR__ . '/../' . $footerMarketImage)): ?>
                    <img src="<?= htmlspecialchars($footerMarketImage, ENT_QUOTES, 'UTF-8') ?>" alt="Global Outsource's focus markets: the United Kingdom, Ireland, the United States and Pakistan" width="720" height="405" loading="lazy">
                <?php else: ?>
                    <div class="footer-map-placeholder" role="img" aria-label="Add a focus markets image to assets/markets/focus-markets.png">720 × 405 px PNG</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-bottom-inner section-shell">
            <p>© <?= date('Y') ?> Global Outsource Pvt Ltd. All Rights Reserved.</p>
        </div>
    </div>
</footer>
</body>
</html>
