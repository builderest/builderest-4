<section class="section page-hero">
    <div class="container narrow">
        <h1>All Services</h1>
        <p>From security infrastructure to immersive entertainment, explore our fully managed solutions.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="card-grid services-list">
            <?php foreach ($services as $service): ?>
                <article class="service-card">
                    <div class="icon-badge">
                        <img src="<?php echo htmlspecialchars($service['icon']); ?>" alt="<?php echo htmlspecialchars($service['name']); ?> icon">
                    </div>
                    <h3><a href="/services/<?php echo urlencode($service['slug']); ?>"><?php echo htmlspecialchars($service['name']); ?></a></h3>
                    <p class="price">Starting at $<?php echo number_format($service['starting_price'], 2); ?></p>
                    <p><?php echo htmlspecialchars($service['short_description']); ?></p>
                    <div class="card-actions">
                        <a class="btn btn-link" href="/services/<?php echo urlencode($service['slug']); ?>">Read more</a>
                        <a class="btn btn-small" href="/quote?service=<?php echo urlencode($service['slug']); ?>">Get a quote</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
