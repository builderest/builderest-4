<?php
/** @var callable $content */
$standalone = $standalone ?? false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Builderest Admin</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <script defer src="/assets/js/admin.js"></script>
</head>
<body class="admin-body">
    <?php if ($standalone): ?>
        <div class="admin-standalone">
            <?php $content(); ?>
        </div>
    <?php else: ?>
        <div class="admin-wrapper">
            <aside class="admin-sidebar">
                <?php include __DIR__ . '/../partials/admin-sidebar.php'; ?>
            </aside>
            <div class="admin-content">
                <?php $content(); ?>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
