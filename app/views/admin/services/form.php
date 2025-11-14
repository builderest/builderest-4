<section class="admin-header">
    <div>
        <h1><?php echo isset($service) ? 'Edit service' : 'Create service'; ?></h1>
        <p>Define the key details customers will see.</p>
    </div>
</section>
<section class="admin-section">
    <form method="post" class="admin-form">
        <div class="form-grid">
            <div class="form-group <?php echo isset($errors['name']) ? 'has-error' : ''; ?>">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($service['name'] ?? ($_POST['name'] ?? '')); ?>" required>
                <?php if (isset($errors['name'])): ?><span class="error"><?php echo $errors['name']; ?></span><?php endif; ?>
            </div>
            <div class="form-group <?php echo isset($errors['slug']) ? 'has-error' : ''; ?>">
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" value="<?php echo htmlspecialchars($service['slug'] ?? ($_POST['slug'] ?? '')); ?>" required>
                <?php if (isset($errors['slug'])): ?><span class="error"><?php echo $errors['slug']; ?></span><?php endif; ?>
            </div>
            <div class="form-group <?php echo isset($errors['category']) ? 'has-error' : ''; ?>">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <?php $current = $service['category'] ?? ($_POST['category'] ?? ''); ?>
                    <?php foreach (['smart-home' => 'Smart Home', 'security' => 'Security', 'audio-video' => 'Audio/Video', 'business' => 'Business', 'installation' => 'Installation'] as $value => $label): ?>
                        <option value="<?php echo $value; ?>" <?php echo $current === $value ? 'selected' : ''; ?>><?php echo $label; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['category'])): ?><span class="error"><?php echo $errors['category']; ?></span><?php endif; ?>
            </div>
            <div class="form-group <?php echo isset($errors['starting_price']) ? 'has-error' : ''; ?>">
                <label for="starting_price">Starting price</label>
                <input type="number" step="0.01" id="starting_price" name="starting_price" value="<?php echo htmlspecialchars($service['starting_price'] ?? ($_POST['starting_price'] ?? '0')); ?>" required>
                <?php if (isset($errors['starting_price'])): ?><span class="error"><?php echo $errors['starting_price']; ?></span><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="icon">Icon (path to SVG)</label>
                <input type="text" id="icon" name="icon" value="<?php echo htmlspecialchars($service['icon'] ?? ($_POST['icon'] ?? '/assets/img/icon.svg')); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="short_description">Short description</label>
            <textarea id="short_description" name="short_description" rows="3" required><?php echo htmlspecialchars($service['short_description'] ?? ($_POST['short_description'] ?? '')); ?></textarea>
        </div>
        <div class="form-group">
            <label for="description">Detailed description</label>
            <textarea id="description" name="description" rows="6" required><?php echo htmlspecialchars($service['description'] ?? ($_POST['description'] ?? '')); ?></textarea>
        </div>
        <div class="form-group">
            <label for="features">Benefits (one per line)</label>
            <textarea id="features" name="features" rows="5" required><?php echo htmlspecialchars($service['features'] ?? ($_POST['features'] ?? '')); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save service</button>
        <a class="btn btn-link" href="/admin/services">Cancel</a>
    </form>
</section>
