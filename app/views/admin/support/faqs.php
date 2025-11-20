<section class="admin-header">
    <div>
        <h1>FAQs</h1>
        <p>Maintain the knowledge base and support workflows.</p>
    </div>
    <a class="btn btn-primary" href="/admin/faqs/create">Add FAQ</a>
</section>
<section class="admin-section">
    <div class="table">
        <div class="table-row table-head">
            <div>Question</div>
            <div>Updated</div>
            <div>Actions</div>
        </div>
        <?php foreach ($faqs as $faq): ?>
            <div class="table-row">
                <div><?php echo htmlspecialchars($faq['question']); ?></div>
                <div><?php echo date('M d, Y', strtotime($faq['created_at'])); ?></div>
                <div class="table-actions">
                    <a class="btn btn-link" href="/admin/faqs/<?php echo $faq['id']; ?>/edit">Edit</a>
                    <form method="post" action="/admin/faqs/<?php echo $faq['id']; ?>/delete" onsubmit="return confirm('Delete this FAQ?');">
                        <button type="submit" class="btn btn-link danger">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
