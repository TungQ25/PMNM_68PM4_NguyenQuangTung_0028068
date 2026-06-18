<?php
/** @var string $base */
/** @var array|null $user */
$requestPath = parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?: '/';
$basePath = $base !== '' ? parse_url($base, PHP_URL_PATH) : '';

if ($basePath !== '' && strpos($requestPath, $basePath) === 0) {
    $requestPath = substr($requestPath, strlen($basePath)) ?: '/';
}

$isActive = static function (string $path, bool $includeChildren = false) use ($requestPath): string {
    if ($requestPath === $path) {
        return ' class="active"';
    }

    if ($includeChildren && $path !== '/' && str_starts_with($requestPath, $path . '/')) {
        return ' class="active"';
    }

    return '';
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
            <a href="<?= htmlspecialchars($url('/'), ENT_QUOTES, 'UTF-8') ?>"<?= $isActive('/') ?>>Trang chủ</a>
            <a href="<?= htmlspecialchars($url('/home/gioithieu'), ENT_QUOTES, 'UTF-8') ?>"<?= $isActive('/home/gioithieu') ?>>Giới thiệu</a>
            <a href="<?= htmlspecialchars($url('/sinhvien'), ENT_QUOTES, 'UTF-8') ?>"<?= $isActive('/sinhvien', true) ?>>Sinh viên</a>
            <a href="<?= htmlspecialchars($url('/lophoc'), ENT_QUOTES, 'UTF-8') ?>"<?= $isActive('/lophoc', true) ?>>Lớp học</a>
            <?php if ($user): ?>
                <a href="<?= htmlspecialchars($url('/auth/logout'), ENT_QUOTES, 'UTF-8') ?>">Đăng xuất</a>
            <?php else: ?>
                <a href="<?= htmlspecialchars($url('/auth/login'), ENT_QUOTES, 'UTF-8') ?>"<?= $isActive('/auth/login') ?>>Đăng nhập</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
