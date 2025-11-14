<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <h3>Builderest</h3>
            <p>Advanced security, automation, and AV solutions engineered for modern living and high-performing businesses.</p>
        </div>
        <div>
            <h4>Contact</h4>
            <ul>
                <li><span>Phone:</span> <?php echo htmlspecialchars(setting('contact_phone', '+1 (800) 000-0000')); ?></li>
                <li><span>Email:</span> <a href="mailto:<?php echo htmlspecialchars(setting('contact_email', 'info@builderest.com')); ?>"><?php echo htmlspecialchars(setting('contact_email', 'info@builderest.com')); ?></a></li>
                <li><span>Address:</span> <?php echo htmlspecialchars(setting('contact_address', 'Global Operations - Remote First')); ?></li>
            </ul>
        </div>
        <div>
            <h4>Quick links</h4>
            <ul>
                <li><a href="/services">Services</a></li>
                <li><a href="/pricing">Pricing</a></li>
                <li><a href="/quote">Request a quote</a></li>
                <li><a href="/support">FAQ &amp; Support</a></li>
            </ul>
        </div>
        <div>
            <h4>Follow</h4>
            <div class="social-links">
                <a href="<?php echo htmlspecialchars(setting('social_facebook', '#')); ?>">Facebook</a>
                <a href="<?php echo htmlspecialchars(setting('social_instagram', '#')); ?>">Instagram</a>
                <a href="<?php echo htmlspecialchars(setting('social_tiktok', '#')); ?>">TikTok</a>
                <a href="<?php echo htmlspecialchars(setting('social_youtube', '#')); ?>">YouTube</a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Builderest. All rights reserved.</p>
    </div>
</footer>
