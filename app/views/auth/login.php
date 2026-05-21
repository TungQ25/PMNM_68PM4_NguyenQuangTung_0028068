<?php
/** @var string $error */
?>
<section class="card auth-card">
    <h1>Đăng nhập</h1>

    <?php if ($error !== ''): ?>
        <div class="alert error-alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form class="form" method="post" action="<?= htmlspecialchars((defined('BASE_URL') ? BASE_URL : '') . '/auth/login', ENT_QUOTES, 'UTF-8') ?>">
        <label>
            Tên đăng nhập
            <input type="text" name="username" autocomplete="username" required>
        </label>

        <label>
            Mật khẩu
            <input type="password" name="password" autocomplete="current-password" required>
        </label>

        <div class="form-actions">
            <button type="submit" class="btn primary">Đăng nhập</button>
        </div>
    </form>
</section>
