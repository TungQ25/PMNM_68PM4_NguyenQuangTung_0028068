<?php
/** @var string $content */
/** @var string $pageTitle */
$base = defined('BASE_URL') ? BASE_URL : '';
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
    <header class="site-header">
        <div class="container header-inner">
            <a class="logo" href="<?= htmlspecialchars($base ?: '/', ENT_QUOTES, 'UTF-8') ?>">PMNM</a>
            <nav class="nav">
                <a href="<?= htmlspecialchars($base ?: '/', ENT_QUOTES, 'UTF-8') ?>">Trang chủ</a>
                <a href="<?= htmlspecialchars($base . '/home/gioithieu', ENT_QUOTES, 'UTF-8') ?>">Giới thiệu</a>
                <a href="<?= htmlspecialchars($base . '/sinhvien', ENT_QUOTES, 'UTF-8') ?>">Sinh viên</a>
                <a href="<?= htmlspecialchars($base . '/sinhvien/create', ENT_QUOTES, 'UTF-8') ?>">Tạo SV</a>
            </nav>
        </div>
    </header>
    <main class="container main">
        <?= $content ?>
    </main>
    <!-- <footer class="site-footer">
        <div class="container">© <?= date('Y') ?> — Nguyễn Quang Tùng</div>
    </footer> -->
</body>
</html>
