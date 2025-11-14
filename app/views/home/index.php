<?php
$highlightFeatures = [
    'tv-mounting' => ['Precision placement & calibration', 'Clean cable management'],
    'security-cameras' => ['4K & night vision ready', 'Remote monitoring setup'],
    'projector-installation' => ['Custom screen alignment', 'Surround audio integration'],
];
$solutionAreas = [
    ['anchor' => 'smart-lighting', 'title' => 'Automation', 'description' => 'Scene-based lighting, climate, and voice control for smarter living.'],
    ['anchor' => 'security-cameras', 'title' => 'Security', 'description' => 'Surveillance, intrusion prevention, and rapid-response monitoring.'],
    ['anchor' => 'network-hardening', 'title' => 'IT & Networking', 'description' => 'Robust wired and wireless networking for uninterrupted uptime.'],
    ['anchor' => 'conference-rooms', 'title' => 'Business', 'description' => 'Conference, collaboration, and managed workplace technology.'],
    ['anchor' => 'home-theater', 'title' => 'Residential', 'description' => 'Comfort, entertainment, and automation engineered for homes.'],
    ['anchor' => 'tv-mounting', 'title' => 'Installations', 'description' => 'Audio/video installs, mounting, and custom fabrication.'],
];
$whyItems = [
    ['title' => 'Certified Technicians', 'description' => 'Licensed experts with cross-disciplinary credentials delivering premium workmanship.'],
    ['title' => '24/7 Remote Support', 'description' => 'Always-on monitoring with proactive alerts and rapid response.'],
    ['title' => 'Custom Architectures', 'description' => 'Solutions tailored to your environment, scale, and compliance needs.'],
    ['title' => 'Enterprise Security', 'description' => 'Zero-trust policies, encryption, and hardened deployments from day one.'],
    ['title' => 'Seamless Integrations', 'description' => 'Connect disparate platforms into a unified, intuitive experience.'],
    ['title' => 'Proven Delivery', 'description' => 'Documented playbooks to deploy, train, and support without disruption.'],
];
?>
<section class="hero" data-hero>
    <div class="hero-backdrop" aria-hidden="true"></div>
    <div class="container hero-inner">
        <div class="hero-copy">
            <p class="eyebrow">Integrated protection &amp; automation</p>
            <h1><?= htmlspecialchars($heroTitle); ?></h1>
            <p class="lead"><?= htmlspecialchars($heroSubtitle); ?></p>
            <div class="hero-actions">
                <a href="/quote" class="btn btn-cta">Get a Free Quote</a>
                <a href="/services" class="btn btn-secondary">View Services</a>
            </div>
            <dl class="hero-metrics">
                <div>
                    <dt>Secure deployments</dt>
                    <dd>250+</dd>
                </div>
                <div>
                    <dt>Average uptime</dt>
                    <dd>99.9%</dd>
                </div>
                <div>
                    <dt>Support availability</dt>
                    <dd>24/7</dd>
                </div>
            </dl>
        </div>
        <div class="hero-visual">
            <div class="status-card">
                <header>
                    <span class="status-indicator" aria-hidden="true"></span>
                    <span>Operations Center</span>
                </header>
                <strong>All systems optimal</strong>
                <p>Last sync <?= date('H:i'); ?> UTC</p>
                <ul>
                    <li>Camera grid &bull; Online</li>
                    <li>Access control &bull; Synced</li>
                    <li>Automation scenes &bull; Active</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section highlight-services">
    <div class="container">
        <div class="section-heading">
            <h2>Top Installation Services</h2>
            <p>High-impact deployments engineered for reliability from the very first day.</p>
        </div>
        <div class="card-grid">
            <?php foreach ($topServices as $service): ?>
                <?php
                $slug = $service['slug'];
                $features = $highlightFeatures[$slug] ?? ['Tailored installation plan', 'Premium project support'];
                $icon = !empty($service['icon']) ? $service['icon'] : '/assets/img/default-service.svg';
                ?>
                <article class="service-highlight">
                    <div class="service-header">
                        <span class="service-icon"><img src="<?= htmlspecialchars($icon); ?>" alt="<?= htmlspecialchars($service['name']); ?> icon"></span>
                        <div>
                            <h3><?= htmlspecialchars($service['name']); ?></h3>
                            <p class="service-price">Starting at $<?= number_format((float) $service['starting_price'], 2); ?></p>
                        </div>
                    </div>
                    <p class="service-description"><?= htmlspecialchars($service['short_description']); ?></p>
                    <ul class="service-features">
                        <?php foreach ($features as $feature): ?>
                            <li><?= htmlspecialchars($feature); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="service-actions">
                        <a class="btn btn-link" href="/services/<?= urlencode($slug); ?>">Learn More</a>
                        <a class="btn btn-ghost" href="/quote?service=<?= urlencode($slug); ?>">Get a Quote</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section solutions-overview" id="solutions">
    <div class="container">
        <div class="section-heading">
            <h2>Solutions engineered for every environment</h2>
            <p>From intelligent homes to resilient enterprises, Builderest delivers cohesive ecosystems that simply work.</p>
        </div>
        <div class="solutions-grid">
            <?php foreach ($solutionAreas as $area): ?>
                <article class="solution-card">
                    <span class="solution-icon" aria-hidden="true"></span>
                    <h3><?= htmlspecialchars($area['title']); ?></h3>
                    <p><?= htmlspecialchars($area['description']); ?></p>
                    <a class="btn btn-link" href="/services#<?= urlencode($area['anchor']); ?>">View details</a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section why-us">
    <div class="container">
        <div class="section-heading">
            <h2>Why clients choose Builderest</h2>
            <p>We operate as an extension of your team, orchestrating the technology that protects and powers your spaces.</p>
        </div>
        <div class="benefits-grid">
            <?php foreach ($whyItems as $item): ?>
                <article class="benefit-card">
                    <h3><?= htmlspecialchars($item['title']); ?></h3>
                    <p><?= htmlspecialchars($item['description']); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section cta-band">
    <div class="container cta-inner">
        <div>
            <h2>Ready to upgrade your home or business?</h2>
            <p>Let our specialists architect a solution tailored to your security, automation, and connectivity goals.</p>
        </div>
        <a class="btn btn-cta" href="/quote">Get a Free Quote</a>
    </div>
</section>

<section class="section latest-insights">
    <div class="container">
        <div class="section-heading">
            <h2>Latest insights</h2>
            <p>Strategic guidance for leaders transforming their environments through smart technology.</p>
        </div>
        <div class="card-grid">
            <?php foreach ($posts as $post): ?>
                <article class="post-card">
                    <span class="post-date"><?= date('M d, Y', strtotime($post['created_at'])); ?></span>
                    <h3><?= htmlspecialchars($post['title']); ?></h3>
                    <p><?= htmlspecialchars($post['excerpt']); ?></p>
                    <a class="btn btn-link" href="/blog/<?= urlencode($post['slug']); ?>">Read more</a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
