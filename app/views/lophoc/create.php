<?php
$old = $old ?? ['malop' => '', 'tenlop' => ''];
$base = defined('BASE_URL') ? BASE_URL : '';
?>
<section class="card">
    <h1>Thêm lớp học</h1>

    <?php if (!empty($error)): ?>
        <div class="alert error-alert"><?= htmlspecialchars((string) $error, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert success-alert"><?= htmlspecialchars((string) $success, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form class="form" method="post" action="<?= htmlspecialchars($base . '/lophoc/create', ENT_QUOTES, 'UTF-8') ?>">
        <label>
            Mã lớp
            <input type="text" name="malop" placeholder="68PM4" value="<?= htmlspecialchars((string) ($old['malop'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
        </label>

        <label>
            Tên lớp
            <input type="text" name="tenlop" placeholder="Công nghệ phần mềm" value="<?= htmlspecialchars((string) ($old['tenlop'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
        </label>

        <div class="form-actions">
            <button type="submit" class="btn primary">Lưu</button>
            <a class="btn ghost" href="<?= htmlspecialchars($base . '/lophoc', ENT_QUOTES, 'UTF-8') ?>">Quay lại danh sách</a>
        </div>
    </form>
</section>
