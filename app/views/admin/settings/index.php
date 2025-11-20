<section class="admin-header">
    <div>
        <h1>Site settings</h1>
        <p>Control headline messaging, contact information, and social presence.</p>
    </div>
</section>
<section class="admin-section">
    <?php if ($status): ?>
        <div class="alert success"><?php echo $status; ?></div>
    <?php endif; ?>
    <form method="post" class="admin-form">
        <div class="form-grid">
            <div class="form-group">
                <label for="hero_title">Hero title</label>
                <input type="text" id="hero_title" name="hero_title" value="<?php echo htmlspecialchars($settings['hero_title'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="hero_subtitle">Hero subtitle</label>
                <input type="text" id="hero_subtitle" name="hero_subtitle" value="<?php echo htmlspecialchars($settings['hero_subtitle'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="contact_phone">Primary phone</label>
                <input type="text" id="contact_phone" name="contact_phone" value="<?php echo htmlspecialchars($settings['contact_phone'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="contact_email">Public email</label>
                <input type="email" id="contact_email" name="contact_email" value="<?php echo htmlspecialchars($settings['contact_email'] ?? ''); ?>">
            </div>
            <div class="form-group full">
                <label for="contact_address">Address</label>
                <input type="text" id="contact_address" name="contact_address" value="<?php echo htmlspecialchars($settings['contact_address'] ?? ''); ?>">
            </div>
        </div>
        <h2>Social</h2>
        <div class="form-grid">
            <div class="form-group">
                <label for="social_facebook">Facebook</label>
                <input type="url" id="social_facebook" name="social_facebook" value="<?php echo htmlspecialchars($settings['social_facebook'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="social_instagram">Instagram</label>
                <input type="url" id="social_instagram" name="social_instagram" value="<?php echo htmlspecialchars($settings['social_instagram'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="social_tiktok">TikTok</label>
                <input type="url" id="social_tiktok" name="social_tiktok" value="<?php echo htmlspecialchars($settings['social_tiktok'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="social_youtube">YouTube</label>
                <input type="url" id="social_youtube" name="social_youtube" value="<?php echo htmlspecialchars($settings['social_youtube'] ?? ''); ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save settings</button>
    </form>
</section>
