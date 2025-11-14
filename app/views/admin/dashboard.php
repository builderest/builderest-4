<section class="admin-header">
    <div>
        <h1>Dashboard</h1>
        <p>Monitor performance, leads, and content at a glance.</p>
    </div>
</section>
<section class="admin-section">
    <div class="stat-grid">
        <div class="stat-card">
            <span class="label">Services</span>
            <strong><?php echo $stats['services']; ?></strong>
        </div>
        <div class="stat-card">
            <span class="label">Quotes</span>
            <strong><?php echo $stats['quotes']; ?></strong>
        </div>
        <div class="stat-card">
            <span class="label">Blog posts</span>
            <strong><?php echo $stats['posts']; ?></strong>
        </div>
    </div>
</section>
<section class="admin-section">
    <h2>Latest quote requests</h2>
    <div class="table">
        <div class="table-row table-head">
            <div>Name</div>
            <div>Email</div>
            <div>Service</div>
            <div>Status</div>
            <div>Received</div>
        </div>
        <?php foreach ($latestQuotes as $quote): ?>
            <div class="table-row">
                <div><?php echo htmlspecialchars($quote['name']); ?></div>
                <div><?php echo htmlspecialchars($quote['email']); ?></div>
                <div><?php echo htmlspecialchars($quote['service_slug'] ?? 'N/A'); ?></div>
                <div><?php echo htmlspecialchars($quote['status']); ?></div>
                <div><?php echo date('M d, Y', strtotime($quote['created_at'])); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
