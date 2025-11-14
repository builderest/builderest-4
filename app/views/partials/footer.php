<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-column footer-brand">
            <a class="footer-logo" href="/">
                <span class="footer-logo-mark">
                    <img src="/assets/img/logo-light-theme.svg" alt="Builderest logo" width="46" height="46">
                </span>
                <span class="footer-logo-copy">
                    <span class="footer-logo-name">BUILDEReST</span>
                    <span class="footer-logo-tagline">Smart Home &amp; Business Solutions</span>
                </span>
            </a>
            <p>Advanced security, automation, and AV solutions engineered for modern living and high-performing businesses.</p>
            <ul class="footer-contact">
                <li><span>Phone</span><a href="tel:<?php echo preg_replace('/[^\d\+]/', '', setting('contact_phone', '+18555550184')); ?>"><?php echo htmlspecialchars(setting('contact_phone', '+1 (855) 555-0184')); ?></a></li>
                <li><span>Email</span><a href="mailto:<?php echo htmlspecialchars(setting('contact_email', 'info@builderest.com')); ?>"><?php echo htmlspecialchars(setting('contact_email', 'info@builderest.com')); ?></a></li>
                <li><span>Address</span><span><?php echo htmlspecialchars(setting('contact_address', 'Global Command Center, Remote First')); ?></span></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Quick Links</h4>
            <ul class="footer-links">
                <li><a href="/">Home</a></li>
                <li><a href="/services">Services</a></li>
                <li><a href="/pricing">Pricing</a></li>
                <li><a href="/projects">Projects</a></li>
                <li><a href="/support">Support</a></li>
                <li><a href="/quote">Request a quote</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Connect</h4>
            <ul class="social-links">
                <li>
                    <a href="<?php echo htmlspecialchars(setting('social_facebook', '#')); ?>" target="_blank" rel="noopener">
                        <span class="social-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.5 8.5H16V6h-1.5c-1.65 0-3 1.35-3 3v2H9v2.5h2.5V21h2.5v-7.5H16l.5-2.5h-3v-1c0-.55.45-1 1-1Z" fill="currentColor"/>
                            </svg>
                        </span>
                        <span>Facebook</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo htmlspecialchars(setting('social_instagram', '#')); ?>" target="_blank" rel="noopener">
                        <span class="social-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.2 4h9.6A3.2 3.2 0 0 1 20 7.2v9.6A3.2 3.2 0 0 1 16.8 20H7.2A3.2 3.2 0 0 1 4 16.8V7.2A3.2 3.2 0 0 1 7.2 4Zm0 2A1.2 1.2 0 0 0 6 7.2v9.6A1.2 1.2 0 0 0 7.2 18h9.6a1.2 1.2 0 0 0 1.2-1.2V7.2A1.2 1.2 0 0 0 16.8 6H7.2Zm9.55 1.2a.9.9 0 1 1 0 1.8.9.9 0 0 1 0-1.8ZM12 8.2A3.8 3.8 0 1 1 12 15.8 3.8 3.8 0 0 1 12 8.2Zm0 2A1.8 1.8 0 1 0 12 13.8 1.8 1.8 0 0 0 12 10.2Z" fill="currentColor"/>
                            </svg>
                        </span>
                        <span>Instagram</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo htmlspecialchars(setting('social_tiktok', '#')); ?>" target="_blank" rel="noopener">
                        <span class="social-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.5 5.2c.8.68 1.8 1.08 2.9 1.1V9.4a5.7 5.7 0 0 1-3-.8v5.15c0 2.87-2.28 5.25-5.1 5.25S5.2 16.62 5.2 13.75 7.48 8.5 10.3 8.5c.3 0 .6.03.9.08v2.6a2.6 2.6 0 0 0-.9-.16 2.55 2.55 0 0 0 0 5.1 2.55 2.55 0 0 0 2.55-2.55V3h2.65v2.2Z" fill="currentColor"/>
                            </svg>
                        </span>
                        <span>TikTok</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo htmlspecialchars(setting('social_youtube', '#')); ?>" target="_blank" rel="noopener">
                        <span class="social-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 8.2a2.7 2.7 0 0 0-1.9-1.9C17.3 6 12 6 12 6s-5.3 0-7.1.3A2.7 2.7 0 0 0 3 8.2 28.4 28.4 0 0 0 2.7 12a28.4 28.4 0 0 0 .3 3.8 2.7 2.7 0 0 0 1.9 1.9C6.7 18 12 18 12 18s5.3 0 7.1-.3a2.7 2.7 0 0 0 1.9-1.9c.2-1.2.3-2.5.3-3.8a28.4 28.4 0 0 0-.3-3.8ZM10.2 14.6V9.4L15 12l-4.8 2.6Z" fill="currentColor"/>
                            </svg>
                        </span>
                        <span>YouTube</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Builderest. All rights reserved.</p>
    </div>
</footer>
