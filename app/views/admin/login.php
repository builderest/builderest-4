<section class="auth-card">
    <h1>Builderest Admin</h1>
    <p>Sign in to manage services, content, and customer requests.</p>
    <?php if (!empty($errors['general'])): ?>
        <div class="alert error"><?php echo $errors['general']; ?></div>
    <?php endif; ?>
    <form method="post" class="auth-form">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary full">Login</button>
        <a class="forgot-link" href="/password/forgot">Forgot your password?</a>
    </form>
</section>
