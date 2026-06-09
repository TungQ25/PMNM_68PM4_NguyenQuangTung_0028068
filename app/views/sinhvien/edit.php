<?php
$old = $old ?? ['hoten' => '', 'masv' => ''];
$sinhvienId = isset($sinhvienId) ? (int) $sinhvienId : 0;
$base = defined('BASE_URL') ? BASE_URL : '';
?>
<section class="card">
    <h1>Cập nhật sinh viên</h1>

    <?php if (!empty($error)): ?>
        <div class="alert error-alert"><?= htmlspecialchars((string) $error, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert success-alert"><?= htmlspecialchars((string) $success, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form class="form" method="post" action="<?= htmlspecialchars($base . '/sinhvien/edit/' . $sinhvienId, ENT_QUOTES, 'UTF-8') ?>">
        <label>
            Họ tên
            <input type="text" name="hoten" placeholder="Nguyễn Văn A" autocomplete="name" value="<?= htmlspecialchars((string) ($old['hoten'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
        </label>

        <label>
            Mã SV
            <input type="text" name="masv" placeholder="SV001" value="<?= htmlspecialchars((string) ($old['masv'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
        </label>

        <div class="form-actions">
            <button type="submit" class="btn primary">Cập nhật</button>
            <a class="btn ghost" href="<?= htmlspecialchars($base . '/sinhvien', ENT_QUOTES, 'UTF-8') ?>">Quay lại danh sách</a>
        </div>
    </form>
</section>
