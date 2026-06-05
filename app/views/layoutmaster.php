<?php
/** @var string $content */
/** @var string $pageTitle */
$base = defined('BASE_URL') ? BASE_URL : '';
$user = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="<?= htmlspecialchars($base, ENT_QUOTES, 'UTF-8') ?>/css/style.css">
</head>
<body>
    <?php require ROOT_PATH . '/app/views/partials/header.php'; ?>

    <main class="container main">
        <?= $content ?>
    </main>

    <?php require ROOT_PATH . '/app/views/partials/footer.php'; ?>
</body>
</html>
