<?php if (!$post): ?>
<section class="section">
    <div class="container narrow">
        <h1>Article not found</h1>
        <p>The post you are looking for might have been archived. Browse the <a href="/blog">latest insights</a>.</p>
    </div>
</section>
<?php else: ?>
<section class="section page-hero">
    <div class="container narrow">
        <p class="post-date"><?php echo date('M d, Y', strtotime($post['created_at'])); ?></p>
        <h1><?php echo htmlspecialchars($post['title']); ?></h1>
        <p class="lead"><?php echo htmlspecialchars($post['excerpt']); ?></p>
    </div>
</section>
<section class="section">
    <div class="container narrow rich-text">
        <?php echo nl2br(htmlspecialchars($post['content'])); ?>
    </div>
</section>
<?php endif; ?>
