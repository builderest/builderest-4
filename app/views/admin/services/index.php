<section class="admin-header">
    <div>
        <h1>Services</h1>
        <p>Manage the portfolio of Builderest offerings.</p>
    </div>
    <a class="btn btn-primary" href="/admin/services/create">Add service</a>
</section>
<section class="admin-section">
    <div class="table">
        <div class="table-row table-head">
            <div>Name</div>
            <div>Category</div>
            <div>Starting price</div>
            <div>Actions</div>
        </div>
        <?php foreach ($services as $service): ?>
            <div class="table-row">
                <div><?php echo htmlspecialchars($service['name']); ?></div>
                <div><?php echo htmlspecialchars($service['category']); ?></div>
                <div>$<?php echo number_format($service['starting_price'], 2); ?></div>
                <div class="table-actions">
                    <a class="btn btn-link" href="/admin/services/<?php echo $service['id']; ?>/edit">Edit</a>
                    <form method="post" action="/admin/services/<?php echo $service['id']; ?>/delete" onsubmit="return confirm('Delete this service?');">
                        <button type="submit" class="btn btn-link danger">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
