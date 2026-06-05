<?php
/** @var string $base */
/** @var array|null $user */
$requestPath = parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?: '/';
$basePath = $base !== '' ? parse_url($base, PHP_URL_PATH) : '';

if ($basePath !== '' && strpos($requestPath, $basePath) === 0) {
    $requestPath = substr($requestPath, strlen($basePath)) ?: '/';
}

$isActive = static function (string $path) use ($requestPath): string {
    return $requestPath === $path ? ' class="active"' : '';
};

$url = static function (string $path) use ($base): string {
    if ($path === '/') {
        return $base !== '' ? $base : '/';
    }

    return $base . $path;
};
?>
<header class="site-header">
    <div class="container header-inner">
        <a class="logo" href="<?= htmlspecialchars($url('/'), ENT_QUOTES, 'UTF-8') ?>">PMNM</a>
        <nav class="nav">
            <a href="<?= htmlspecialchars($url('/'), ENT_QUOTES, 'UTF-8') ?>"<?= $isActive('/') ?>>Trang ch&#7911;</a>
            <a href="<?= htmlspecialchars($url('/home/gioithieu'), ENT_QUOTES, 'UTF-8') ?>"<?= $isActive('/home/gioithieu') ?>>Gi&#7899;i thi&#7879;u</a>
            <a href="<?= htmlspecialchars($url('/sinhvien'), ENT_QUOTES, 'UTF-8') ?>"<?= $isActive('/sinhvien') ?>>Sinh vi&#234;n</a>
            <a href="<?= htmlspecialchars($url('/sinhvien/create'), ENT_QUOTES, 'UTF-8') ?>"<?= $isActive('/sinhvien/create') ?>>T&#7841;o SV</a>
            <?php if ($user): ?>
                <a href="<?= htmlspecialchars($url('/auth/logout'), ENT_QUOTES, 'UTF-8') ?>">&#272;&#259;ng xu&#7845;t</a>
            <?php else: ?>
                <a href="<?= htmlspecialchars($url('/auth/login'), ENT_QUOTES, 'UTF-8') ?>"<?= $isActive('/auth/login') ?>>&#272;&#259;ng nh&#7853;p</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
