<section class="section page-hero">
    <div class="container narrow">
        <h1>Support &amp; Knowledge Base</h1>
        <p>Answers to the most common questions about our deployment process and ongoing support.</p>
    </div>
</section>
<section class="section">
    <div class="container faq-container">
        <div class="accordion" data-accordion>
            <?php foreach ($faqs as $index => $faq): ?>
                <div class="accordion-item">
                    <button class="accordion-trigger" aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                        <span><?php echo htmlspecialchars($faq['question']); ?></span>
                        <span class="icon">+</span>
                    </button>
                    <div class="accordion-content" <?php echo $index === 0 ? 'style="max-height: 400px;"' : ''; ?>>
                        <p><?php echo nl2br(htmlspecialchars($faq['answer'])); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <aside class="support-card">
            <h3>Need direct assistance?</h3>
            <p>Contact our 24/7 support desk for urgent requests or escalations.</p>
            <a class="btn btn-outline" href="mailto:<?php echo htmlspecialchars(setting('contact_email', 'info@builderest.com')); ?>">Email support</a>
            <a class="btn btn-link" href="/contact">Open a ticket</a>
        </aside>
    </div>
</section>
