<section class="card">
    <h1>Thêm sinh viên</h1>
    <?php $old = $old ?? ['hoten' => '', 'masv' => '']; ?>
    <?php if (!empty($error)): ?>
        <p class="muted"><?= htmlspecialchars((string) $error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>
    <form class="form" method="post" action="<?= htmlspecialchars((defined('BASE_URL') ? BASE_URL : '') . '/sinhvien/create', ENT_QUOTES, 'UTF-8') ?>">
        <label>
            Họ tên
            <input type="text" name="hoten" placeholder="Nguyễn Văn A" autocomplete="name" value="<?= htmlspecialchars((string) ($old['hoten'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
        </label>
        <label>
            Mã SV
            <input type="text" name="masv" placeholder="SV001" value="<?= htmlspecialchars((string) ($old['masv'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
        </label>
        <div class="form-actions">
            <button type="submit" class="btn primary">Lưu</button> 
            <a class="btn ghost" href="<?= htmlspecialchars((defined('BASE_URL') ? BASE_URL : '') . '/sinhvien', ENT_QUOTES, 'UTF-8') ?>">Quay lại danh sách</a>
        </div>
    </form>
</section>
