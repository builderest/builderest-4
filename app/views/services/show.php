<?php if (!$service): ?>
<section class="section">
    <div class="container narrow">
        <h1>Service not found</h1>
        <p>The service you are looking for is no longer available. Explore our <a href="/services">full catalog</a>.</p>
    </div>
</section>
<?php else: ?>
<section class="section page-hero">
    <div class="container service-header">
        <div>
            <p class="eyebrow"><?php echo strtoupper(str_replace('-', ' ', $service['category'])); ?></p>
            <h1><?php echo htmlspecialchars($service['name']); ?></h1>
            <p class="lead"><?php echo htmlspecialchars($service['short_description']); ?></p>
            <div class="hero-actions">
                <a href="/quote?service=<?php echo urlencode($service['slug']); ?>" class="btn btn-primary">Get a Free Quote</a>
                <span class="starting">Starting at $<?php echo number_format($service['starting_price'], 2); ?></span>
            </div>
        </div>
        <div class="service-icon">
            <img src="<?php echo htmlspecialchars($service['icon']); ?>" alt="<?php echo htmlspecialchars($service['name']); ?> icon">
        </div>
    </div>
</section>
<section class="section">
    <div class="container service-detail">
        <article>
            <h2>What's included</h2>
            <div class="rich-text">
                <?php echo nl2br(htmlspecialchars($service['description'])); ?>
            </div>
        </article>
        <aside>
            <h3>Benefits</h3>
            <ul class="bullet-list">
                <?php foreach (preg_split('/\r?\n/', $service['features']) as $feature): ?>
                    <?php if (trim($feature) === '') continue; ?>
                    <li><?php echo htmlspecialchars($feature); ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="/quote?service=<?php echo urlencode($service['slug']); ?>" class="btn btn-outline full">Request proposal</a>
        </aside>
    </div>
</section>
<section class="section related">
    <div class="container">
        <h3>Explore other solutions</h3>
        <div class="card-grid">
            <?php $count = 0; foreach ($related as $item): if ($count >= 3) break; $count++; ?>
                <article class="service-card">
                    <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                    <p><?php echo htmlspecialchars($item['short_description']); ?></p>
                    <a class="btn btn-link" href="/services/<?php echo urlencode($item['slug']); ?>">View details</a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
