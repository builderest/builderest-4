<section class="admin-header">
    <div>
        <h1><?php echo isset($faq) ? 'Edit FAQ' : 'Create FAQ'; ?></h1>
        <p>Provide clear answers for customers and support agents.</p>
    </div>
</section>
<section class="admin-section">
    <form method="post" class="admin-form">
        <div class="form-group <?php echo isset($errors['question']) ? 'has-error' : ''; ?>">
            <label for="question">Question</label>
            <input type="text" id="question" name="question" value="<?php echo htmlspecialchars($faq['question'] ?? ($_POST['question'] ?? '')); ?>" required>
            <?php if (isset($errors['question'])): ?><span class="error"><?php echo $errors['question']; ?></span><?php endif; ?>
        </div>
        <div class="form-group">
            <label for="answer">Answer</label>
            <textarea id="answer" name="answer" rows="6" required><?php echo htmlspecialchars($faq['answer'] ?? ($_POST['answer'] ?? '')); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save FAQ</button>
        <a class="btn btn-link" href="/admin/faqs">Cancel</a>
    </form>
</section>
