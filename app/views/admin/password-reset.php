<section class="auth-card">
    <h1>Create a new password</h1>
    <?php if (!empty($status)): ?>
        <div class="alert success"><?php echo $status; ?></div>
    <?php endif; ?>
    <?php if (!empty($errors['token'])): ?>
        <div class="alert error"><?php echo $errors['token']; ?></div>
    <?php endif; ?>
    <form method="post" class="auth-form">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <div class="form-group <?php echo isset($errors['password']) ? 'has-error' : ''; ?>">
            <label for="password">New password</label>
            <input type="password" id="password" name="password" required>
            <?php if (isset($errors['password'])): ?><span class="error"><?php echo $errors['password']; ?></span><?php endif; ?>
        </div>
        <div class="form-group <?php echo isset($errors['password_confirmation']) ? 'has-error' : ''; ?>">
            <label for="password_confirmation">Confirm password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            <?php if (isset($errors['password_confirmation'])): ?><span class="error"><?php echo $errors['password_confirmation']; ?></span><?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary full">Update password</button>
        <a class="forgot-link" href="/admin/login">Back to login</a>
    </form>
</section>
