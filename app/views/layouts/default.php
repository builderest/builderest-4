<?php
/** @var callable $content */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Builderest | Secure Automation Experts</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <script defer src="/assets/js/main.js"></script>
</head>
<body class="theme-dark">
<?php include __DIR__ . '/../partials/header.php'; ?>
<main id="main-content">
    <?php $content(); ?>
</main>
<?php include __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
