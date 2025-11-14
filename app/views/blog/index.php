<section class="section page-hero">
    <div class="container narrow">
        <h1>Builderest Insights</h1>
        <p>Strategies and best practices for securing, automating, and future-proofing modern spaces.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="card-grid blog-grid">
            <?php foreach ($posts as $post): ?>
                <article class="post-card">
                    <span class="post-date"><?php echo date('M d, Y', strtotime($post['created_at'])); ?></span>
                    <h2><a href="/blog/<?php echo urlencode($post['slug']); ?>"><?php echo htmlspecialchars($post['title']); ?></a></h2>
                    <p><?php echo htmlspecialchars($post['excerpt']); ?></p>
                    <a class="btn btn-link" href="/blog/<?php echo urlencode($post['slug']); ?>">Read more</a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
