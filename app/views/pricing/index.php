<section class="section page-hero">
    <div class="container narrow">
        <h1>Transparent Pricing</h1>
        <p>Configure your deployment with modular packages crafted for performance and scalability.</p>
    </div>
</section>
<section class="section pricing-section">
    <div class="container">
        <div class="pricing-controls">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="smart-home">Smart Home</button>
            <button class="filter-btn" data-filter="security">Security</button>
            <button class="filter-btn" data-filter="audio-video">Audio/Video</button>
            <button class="filter-btn" data-filter="business">Business</button>
            <button class="filter-btn" data-filter="installation">Installation</button>
        </div>
        <div class="pricing-grid" data-pricing-grid>
            <?php foreach ($services as $service): ?>
                <article class="pricing-card" data-category="<?php echo htmlspecialchars($service['category']); ?>">
                    <h3><?php echo htmlspecialchars($service['name']); ?></h3>
                    <p class="pricing-value">Starting at $<?php echo number_format($service['starting_price'], 2); ?></p>
                    <ul>
                        <?php foreach (array_slice(array_filter(preg_split('/\r?\n/', $service['features'])), 0, 5) as $feature): ?>
                            <li><?php echo htmlspecialchars($feature); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="card-actions">
                        <a class="btn btn-link" href="/services/<?php echo urlencode($service['slug']); ?>">Learn more</a>
                        <a class="btn btn-small" href="/quote?service=<?php echo urlencode($service['slug']); ?>">Get a quote</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="centered">
            <button class="btn btn-outline" id="pricing-see-more">See more</button>
        </div>
    </div>
</section>
