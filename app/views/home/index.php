<section class="hero">
    <div class="container hero-content">
        <div class="hero-text">
            <p class="eyebrow">Enterprise-grade protection</p>
            <h1><?php echo htmlspecialchars($heroTitle); ?></h1>
            <p class="lead"><?php echo htmlspecialchars($heroSubtitle); ?></p>
            <div class="hero-actions">
                <a href="/quote" class="btn btn-primary">Get a Free Quote</a>
                <a href="/services" class="btn btn-outline">View Services</a>
            </div>
            <div class="trust-metrics">
                <div><strong>250+</strong> Smart homes secured</div>
                <div><strong>99.9%</strong> System uptime</div>
                <div><strong>24/7</strong> Remote monitoring</div>
            </div>
        </div>
        <div class="hero-visual">
            <div class="glow"></div>
            <div class="panel">
                <span>Live Status</span>
                <strong>All networks operational</strong>
                <p>Last sync: <?php echo date('H:i'); ?> UTC</p>
            </div>
        </div>
    </div>
</section>

<section class="section top-services">
    <div class="container">
        <div class="section-heading">
            <h2>Top Installation Services</h2>
            <p>Precision deployments engineered to perform from day one.</p>
        </div>
        <div class="card-grid">
            <?php foreach ($topServices as $service): ?>
                <article class="service-card">
                    <div class="icon-badge">
                        <img src="<?php echo htmlspecialchars($service['icon']); ?>" alt="<?php echo htmlspecialchars($service['name']); ?> icon">
                    </div>
                    <h3><?php echo htmlspecialchars($service['name']); ?></h3>
                    <p class="price">Starting at $<?php echo number_format($service['starting_price'], 2); ?></p>
                    <p><?php echo htmlspecialchars($service['short_description']); ?></p>
                    <div class="card-actions">
                        <a class="btn btn-link" href="/services/<?php echo urlencode($service['slug']); ?>">Learn more</a>
                        <a class="btn btn-small" href="/quote?service=<?php echo urlencode($service['slug']); ?>">Get a quote</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section service-overview">
    <div class="container">
        <div class="section-heading">
            <h2>Every space. Every challenge. We have a blueprint.</h2>
            <p>Integrated services for smart homes, resilient businesses, and future-ready operations.</p>
        </div>
        <div class="grid-six">
            <div class="overview-card">Smart Automation</div>
            <div class="overview-card">Security &amp; Surveillance</div>
            <div class="overview-card">Managed IT Support</div>
            <div class="overview-card">Business Continuity</div>
            <div class="overview-card">Residential Comfort</div>
            <div class="overview-card">Audio &amp; Video Mastery</div>
        </div>
        <div class="centered">
            <a href="/services" class="btn btn-primary">View all services</a>
        </div>
    </div>
</section>

<section class="section why-us">
    <div class="container why-grid">
        <div>
            <h2>Why clients choose Builderest</h2>
            <p>From consultation to deployment, we operate as an extension of your team with relentless focus on security, scalability, and delight.</p>
        </div>
        <ul class="bullet-list">
            <li><strong>Certified experts:</strong> Veteran engineers and installers with multi-discipline credentials.</li>
            <li><strong>Always-on support:</strong> Dedicated helpdesk and proactive monitoring 24/7.</li>
            <li><strong>Future proof:</strong> Modular architecture ready for upgrades and integrations.</li>
            <li><strong>Data privacy first:</strong> Encryption, compliance, and governance embedded into every solution.</li>
            <li><strong>Rapid deployment:</strong> Proven playbooks to deliver outcomes faster.</li>
        </ul>
    </div>
</section>

<section class="section latest-insights">
    <div class="container">
        <div class="section-heading">
            <h2>Latest insights</h2>
            <p>Thought leadership for technology decision makers.</p>
        </div>
        <div class="card-grid">
            <?php foreach ($posts as $post): ?>
                <article class="post-card">
                    <span class="post-date"><?php echo date('M d, Y', strtotime($post['created_at'])); ?></span>
                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                    <p><?php echo htmlspecialchars($post['excerpt']); ?></p>
                    <a class="btn btn-link" href="/blog/<?php echo urlencode($post['slug']); ?>">Read more</a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
