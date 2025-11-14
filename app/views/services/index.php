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
                <article class="service-card" id="<?= htmlspecialchars($service['slug']); ?>">
                    <div class="service-card__glow"></div>
                    <div class="service-card__inner">
                        <div class="service-card__header">
                            <span class="service-card__icon">
                                <img src="<?= htmlspecialchars($icon); ?>" alt="<?= htmlspecialchars($service['name']); ?> icon">
                            </span>
                            <div class="service-card__meta">
                                <?php if (!empty($service['category'])): ?>
                                    <span class="service-card__category"><?= str_replace('-', ' ', htmlspecialchars($service['category'])); ?></span>
                                <?php endif; ?>
                                <span class="service-card__price">Starting at $<?= number_format((float) $service['starting_price'], 2); ?></span>
                            </div>
                        </div>
                        <h3 class="service-card__title">
                            <a href="/services/<?= urlencode($service['slug']); ?>"><?= htmlspecialchars($service['name']); ?></a>
                        </h3>
                        <p class="service-card__description"><?= htmlspecialchars($service['short_description']); ?></p>
                        <div class="service-card__footer">
                            <a class="service-card__link" href="/services/<?= urlencode($service['slug']); ?>">
                                Read More <span aria-hidden="true">→</span>
                            </a>
                            <a class="service-card__cta" href="/quote?service=<?= urlencode($service['slug']); ?>">Get a free quote</a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
