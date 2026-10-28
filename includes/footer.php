<?php
require_once __DIR__ . '/business-details.php';
require __DIR__ . '/call-to-action.php';
?>
<footer class="site-footer" id="site-footer">
    <div class="footer-main section-shell">
        <div class="footer-brand-column">
            <a class="footer-brand" href="index" aria-label="Global Outsource home"><img src="logo.png" alt="Global Outsource" width="250" height="88"></a>
            <p>We provide Accountancy and IT Solutions, AI and Software Development services to clients in the UK, Ireland and USA. Helping businesses reduce costs, increase efficiency and achieve sustainable growth.</p>
            <div class="footer-social" aria-hidden="true">
                <span class="social-instagram"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle class="social-icon-dot" cx="17.5" cy="6.5" r="1"/></svg></span>
                <span class="social-facebook"><svg viewBox="0 0 24 24"><path d="M13.5 21v-8h2.7l.4-3h-3.1V8.1c0-.9.3-1.5 1.6-1.5h1.6V3.9c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.3V10H7.2v3H10v8h3.5Z"/></svg></span>
                <span class="social-linkedin"><svg viewBox="0 0 24 24"><path d="M6.5 8.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4ZM4.8 10h3.4v10H4.8zM10.5 10h3.3v1.4c.5-.9 1.6-1.7 3.2-1.7 3.4 0 4 2.2 4 5V20h-3.4v-4.7c0-1.1 0-2.6-1.6-2.6s-1.9 1.2-1.9 2.5V20h-3.4z"/></svg></span>
            </div>
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
            <a href="mailto:info@theglobaloutsource.com"><span class="footer-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 5h18v14H3z"/><path d="m3 6 9 7 9-7"/></svg></span>info@theglobaloutsource.com</a>
            <a href="tel:++923104455625"><span class="footer-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M5 4h4l2 5-2 2a14 14 0 0 0 4 4l2-2 5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"/></svg></span>+92 3104455625</a>
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
