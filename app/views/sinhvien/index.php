<?php
$base = defined('BASE_URL') ? BASE_URL : '';

if (!isset($sinhvien) || !is_array($sinhvien)) {
    $sinhvien = [];
}
?>
<section class="card">
    <h1>Danh sách sinh viên</h1>
    <p>
        <a class="btn primary" href="<?= htmlspecialchars($base . '/sinhvien/create', ENT_QUOTES, 'UTF-8') ?>">Thêm sinh viên</a>
    </p>

    <div class="placeholder-table">
        <?php if ($sinhvien === []): ?>
            <p><em>Chưa có dữ liệu.</em></p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Mã SV</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sinhvien as $index => $sv): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars((string) ($sv['hoten'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars((string) ($sv['masv'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars((string) ($sv['created_at'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>
