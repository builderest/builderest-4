<section class="admin-header">
    <div>
        <h1>Posts</h1>
        <p>Publish announcements and industry insights.</p>
    </div>
    <a class="btn btn-primary" href="/admin/posts/create">New post</a>
</section>
<section class="admin-section">
    <div class="table">
        <div class="table-row table-head">
            <div>Title</div>
            <div>Slug</div>
            <div>Published</div>
            <div>Actions</div>
        </div>
        <?php foreach ($posts as $post): ?>
            <div class="table-row">
                <div><?php echo htmlspecialchars($post['title']); ?></div>
                <div><?php echo htmlspecialchars($post['slug']); ?></div>
                <div><?php echo date('M d, Y', strtotime($post['created_at'])); ?></div>
                <div class="table-actions">
                    <a class="btn btn-link" href="/admin/posts/<?php echo $post['id']; ?>/edit">Edit</a>
                    <form method="post" action="/admin/posts/<?php echo $post['id']; ?>/delete" onsubmit="return confirm('Delete this post?');">
                        <button type="submit" class="btn btn-link danger">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
