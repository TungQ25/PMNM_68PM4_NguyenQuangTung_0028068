<?php
/** @var string $username */
$base = defined('BASE_URL') ? BASE_URL : '';
$displayName = trim((string) $username) !== '' ? (string) $username : 'bạn';
?>
<section class="card hero home-hero">
    <div class="home-hero-content">
        <p class="muted">Xin chào, <?= htmlspecialchars($displayName, ENT_QUOTES, 'UTF-8') ?></p>
        <h1>Quản lý sinh viên</h1>
        <p class="lead">
            Theo dõi sinh viên, lớp học, tìm kiếm, sắp xếp và phân trang trong một giao diện gọn gàng.
        </p>

        <div class="home-actions">
            <a class="btn primary" href="<?= htmlspecialchars($base . '/sinhvien', ENT_QUOTES, 'UTF-8') ?>">Danh sách sinh viên</a>
            <a class="btn primary" href="<?= htmlspecialchars($base . '/lophoc', ENT_QUOTES, 'UTF-8') ?>">Danh sách lớp học</a>
            <a class="btn ghost" href="<?= htmlspecialchars($base . '/home/gioithieu', ENT_QUOTES, 'UTF-8') ?>">Giới thiệu</a>
        </div>
    </div>
</section>

<section class="home-grid">
    <article class="card feature-card">
        <h2>Sinh viên</h2>
        <p class="muted">Thêm, sửa, xóa, tìm kiếm theo MSSV, họ tên và lớp.</p>
        <a class="btn ghost" href="<?= htmlspecialchars($base . '/sinhvien/create', ENT_QUOTES, 'UTF-8') ?>">Thêm sinh viên</a>
    </article>

    <article class="card feature-card">
        <h2>Lớp học</h2>
        <p class="muted">Quản lý mã lớp, tên lớp và dùng mã lớp để gán sinh viên.</p>
        <a class="btn ghost" href="<?= htmlspecialchars($base . '/lophoc/create', ENT_QUOTES, 'UTF-8') ?>">Thêm lớp học</a>
    </article>

    <article class="card feature-card">
        <h2>Tra cứu nhanh</h2>
        <p class="muted">Danh sách sinh viên hỗ trợ lọc, sort theo MSSV/họ tên và chọn số dòng hiển thị.</p>
        <a class="btn ghost" href="<?= htmlspecialchars($base . '/sinhvien', ENT_QUOTES, 'UTF-8') ?>">Tìm sinh viên</a>
    </article>
</section>
