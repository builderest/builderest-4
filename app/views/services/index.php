<section class="services-hero">
    <div class="container services-hero-inner">
        <div>
            <h1>All Services</h1>
            <p>Explore a complete portfolio of Builderest solutions spanning smart homes, enterprise security, networking, and immersive experiences.</p>
        </div>
        <a class="btn btn-cta" href="/quote">Plan your project</a>
    </div>
</section>
<section class="section services-section">
    <div class="container">
        <?php $categoryAnchors = []; ?>
        <div class="services-grid">
            <?php foreach ($services as $service): ?>
                <?php $icon = !empty($service['icon']) ? $service['icon'] : '/assets/img/default-service.svg'; ?>
                <?php
                if (!empty($service['category']) && empty($categoryAnchors[$service['category']])) {
                    $categoryAnchors[$service['category']] = true;
                    printf('<span id="%s" class="category-anchor"></span>', htmlspecialchars($service['category']));
                }
                if ($service['slug'] === 'security-cameras') {
                    echo '<span id="smart-cameras" class="category-anchor"></span>';
                }
                ?>
                <article class="service-panel" id="<?= htmlspecialchars($service['slug']); ?>">
                    <div class="panel-header">
                        <span class="panel-icon"><img src="<?= htmlspecialchars($icon); ?>" alt="<?= htmlspecialchars($service['name']); ?> icon"></span>
                        <div class="panel-meta">
                            <a href="/services/<?= urlencode($service['slug']); ?>" class="panel-title"><?= htmlspecialchars($service['name']); ?></a>
                            <?php if (!empty($service['category'])): ?>
                                <span class="panel-category"><?= str_replace('-', ' ', htmlspecialchars($service['category'])); ?></span>
                            <?php endif; ?>
                        </div>
                        <span class="panel-price">Starting at $<?= number_format((float) $service['starting_price'], 2); ?></span>
                    </div>
                    <p class="panel-description"><?= htmlspecialchars($service['short_description']); ?></p>
                    <div class="panel-actions">
                        <a class="btn btn-link" href="/services/<?= urlencode($service['slug']); ?>">Learn More</a>
                        <a class="btn btn-ghost" href="/quote?service=<?= urlencode($service['slug']); ?>">Get a Quote</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
