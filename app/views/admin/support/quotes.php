<section class="admin-header">
    <div>
        <h1>Quotes</h1>
        <p>Track and manage inbound project requests.</p>
    </div>
</section>
<section class="admin-section">
    <div class="table">
        <div class="table-row table-head">
            <div>Name</div>
            <div>Service</div>
            <div>Email</div>
            <div>Status</div>
            <div>Actions</div>
        </div>
        <?php foreach ($quotes as $quote): ?>
            <div class="table-row">
                <div><?php echo htmlspecialchars($quote['name']); ?></div>
                <div><?php echo htmlspecialchars($quote['service_slug'] ?? 'General'); ?></div>
                <div><?php echo htmlspecialchars($quote['email']); ?></div>
                <div><?php echo htmlspecialchars($quote['status']); ?></div>
                <div>
                    <form method="post" action="/admin/quotes/<?php echo $quote['id']; ?>/status">
                        <select name="status" onchange="this.form.submit()">
                            <?php foreach (['new', 'in-progress', 'closed'] as $status): ?>
                                <option value="<?php echo $status; ?>" <?php echo $quote['status'] === $status ? 'selected' : ''; ?>><?php echo ucfirst(str_replace('-', ' ', $status)); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
