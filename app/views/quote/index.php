<section class="section page-hero">
    <div class="container narrow">
        <h1>Request a Project Quote</h1>
        <p>Share the details of your environment and our architects will deliver a custom solution roadmap.</p>
    </div>
</section>
<section class="section">
    <div class="container form-container">
        <?php if ($success): ?>
            <div class="alert success">Request submitted. Expect a tailored response within one business day.</div>
        <?php endif; ?>
        <form method="post" class="dark-form">
            <input type="hidden" name="service_slug" value="<?php echo htmlspecialchars($serviceSlug); ?>">
            <div class="form-group <?php echo isset($errors['name']) ? 'has-error' : ''; ?>">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
                <?php if (isset($errors['name'])): ?><span class="error"><?php echo $errors['name']; ?></span><?php endif; ?>
            </div>
            <div class="form-group <?php echo isset($errors['email']) ? 'has-error' : ''; ?>">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                <?php if (isset($errors['email'])): ?><span class="error"><?php echo $errors['email']; ?></span><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
            </div>
            <div class="form-group <?php echo isset($errors['message']) ? 'has-error' : ''; ?>">
                <label for="message">Project details</label>
                <textarea id="message" name="message" rows="6" required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                <?php if (isset($errors['message'])): ?><span class="error"><?php echo $errors['message']; ?></span><?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit request</button>
        </form>
    </div>
</section>
