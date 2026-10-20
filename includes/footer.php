<?php
require_once __DIR__ . '/business-details.php';
require __DIR__ . '/call-to-action.php';
?>
<footer class="site-footer" id="site-footer">
    <div class="footer-main section-shell">
        <div class="footer-brand-column">
            <a class="footer-brand" href="index" aria-label="Global Outsource home"><img src="logo.png" alt="Global Outsource" width="250" height="88"></a>
            <p>We provide Accountancy and IT Solutions, AI and Software Development services to clients in the UK, Ireland and USA. Helping businesses reduce costs, increase efficiency and achieve sustainable growth.</p>
            <div class="footer-social" aria-hidden="true"><span>in</span><span>f</span><span><svg viewBox="0 0 24 24"><path d="M4 7h16v10H4z"/><path d="m10 10 5 2-5 2z"/></svg></span><span><svg viewBox="0 0 24 24"><path d="M20.5 11.7a8.4 8.4 0 0 1-12.4 7.4L3 20l.9-4.8a8.4 8.4 0 1 1 16.6-3.5Z"/><path d="M8.3 8.1c.4 2.8 2.4 4.8 5.2 5.5l1.2-1.3 2.2 1.1c-.4 1.6-1.3 2.2-2.6 2.1-3.3-.4-6.4-3.4-6.7-6.7-.1-1.1.5-2.1 1.7-2.4l1.1 2.2z"/></svg></span></div>
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
            <a href="mailto:info@globaloutsource.com"><span class="footer-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 5h18v14H3z"/><path d="m3 6 9 7 9-7"/></svg></span>info@globaloutsource.com</a>
            <a href="tel:+923001234567"><span class="footer-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M5 4h4l2 5-2 2a14 14 0 0 0 4 4l2-2 5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"/></svg></span>+92 300 1234567</a>
            <p><span class="footer-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg></span><span><?= nl2br(htmlspecialchars(implode("\n", OFFICE_ADDRESS_LINES), ENT_QUOTES, 'UTF-8')) ?></span></p>
        </div>
        <div class="footer-column footer-markets">
            <h2>Our Focus Markets</h2>
            <ul class="footer-market-links">
                <li><a href="markets#markets-key-title">United Kingdom</a></li>
                <li><a href="markets#markets-key-title">USA</a></li>
                <li><a href="markets#markets-key-title">Ireland</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-bottom-inner section-shell">
            <p>© <?= date('Y') ?> Global Outsource Pvt Ltd. All Rights Reserved.</p>
            <nav class="footer-legal-links" aria-label="Legal information">
                <a href="privacy-policy">Privacy Policy</a>
                <a href="terms-and-conditions">Terms &amp; Conditions</a>
                <a href="refund-policy">Refund Policy</a>
            </nav>
        </div>
    </div>
</footer>
</body>
</html>
