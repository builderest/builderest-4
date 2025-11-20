<section class="auth-card">
    <h1>Reset password</h1>
    <p>Enter your admin email address to receive a password reset link.</p>
    <?php if (!empty($status)): ?>
        <div class="alert success"><?php echo $status; ?></div>
    <?php endif; ?>
    <form method="post" class="auth-form">
        <div class="form-group <?php echo isset($errors['email']) ? 'has-error' : ''; ?>">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <?php if (isset($errors['email'])): ?><span class="error"><?php echo $errors['email']; ?></span><?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary full">Send reset link</button>
        <a class="forgot-link" href="/admin/login">Back to login</a>
    </form>
</section>
