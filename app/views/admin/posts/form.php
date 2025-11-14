<section class="admin-header">
    <div>
        <h1><?php echo isset($post) ? 'Edit post' : 'Create post'; ?></h1>
        <p>Share updates, case studies, and expert insights.</p>
    </div>
</section>
<section class="admin-section">
    <form method="post" class="admin-form">
        <div class="form-grid">
            <div class="form-group <?php echo isset($errors['title']) ? 'has-error' : ''; ?>">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title'] ?? ($_POST['title'] ?? '')); ?>" required>
                <?php if (isset($errors['title'])): ?><span class="error"><?php echo $errors['title']; ?></span><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" value="<?php echo htmlspecialchars($post['slug'] ?? ($_POST['slug'] ?? '')); ?>" required>
            </div>
            <div class="form-group">
                <label for="thumbnail">Thumbnail URL</label>
                <input type="text" id="thumbnail" name="thumbnail" value="<?php echo htmlspecialchars($post['thumbnail'] ?? ($_POST['thumbnail'] ?? '')); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="excerpt">Excerpt</label>
            <textarea id="excerpt" name="excerpt" rows="3" required><?php echo htmlspecialchars($post['excerpt'] ?? ($_POST['excerpt'] ?? '')); ?></textarea>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" rows="8" required><?php echo htmlspecialchars($post['content'] ?? ($_POST['content'] ?? '')); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save post</button>
        <a class="btn btn-link" href="/admin/posts">Cancel</a>
    </form>
</section>
