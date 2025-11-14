<section class="admin-header">
    <div>
        <h1><?php echo isset($user) ? 'Edit user' : 'Create user'; ?></h1>
        <p>Set access levels for Builderest CMS.</p>
    </div>
</section>
<section class="admin-section">
    <form method="post" class="admin-form">
        <div class="form-grid">
            <div class="form-group <?php echo isset($errors['name']) ? 'has-error' : ''; ?>">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name'] ?? ($_POST['name'] ?? '')); ?>" required>
                <?php if (isset($errors['name'])): ?><span class="error"><?php echo $errors['name']; ?></span><?php endif; ?>
            </div>
            <div class="form-group <?php echo isset($errors['email']) ? 'has-error' : ''; ?>">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ($_POST['email'] ?? '')); ?>" required>
                <?php if (isset($errors['email'])): ?><span class="error"><?php echo $errors['email']; ?></span><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <?php $roleValue = $user['role'] ?? ($_POST['role'] ?? 'editor'); ?>
                <select id="role" name="role">
                    <option value="admin" <?php echo $roleValue === 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="editor" <?php echo $roleValue === 'editor' ? 'selected' : ''; ?>>Editor</option>
                </select>
            </div>
            <div class="form-group <?php echo isset($errors['password']) ? 'has-error' : ''; ?>">
                <label for="password">Password <?php echo isset($user) ? '(leave blank to keep current)' : ''; ?></label>
                <input type="password" id="password" name="password" <?php echo isset($user) ? '' : 'required'; ?>>
                <?php if (isset($errors['password'])): ?><span class="error"><?php echo $errors['password']; ?></span><?php endif; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save user</button>
        <a class="btn btn-link" href="/admin/users">Cancel</a>
    </form>
</section>
