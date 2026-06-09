<?php
$base = defined('BASE_URL') ? BASE_URL : '';

if (!isset($sinhvien) || !is_array($sinhvien)) {
    $sinhvien = [];
}

$currentPage = isset($currentPage) ? (int) $currentPage : 1;
$totalPages = isset($totalPages) ? (int) $totalPages : 1;
$totalRows = isset($totalRows) ? (int) $totalRows : count($sinhvien);
$offset = isset($offset) ? (int) $offset : 0;

$pageUrl = static function (int $page) use ($base): string {
    return $base . '/sinhvien?page=' . $page;
};
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
                        <th>STT</th>
                        <th>Họ tên</th>
                        <th>Mã SV</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sinhvien as $index => $sv): ?>
                        <tr>
                            <td><?= $offset + $index + 1 ?></td>
                            <td><?= htmlspecialchars((string) ($sv['hoten'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars((string) ($sv['masv'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars((string) ($sv['created_at'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <?php if ($totalRows > 0 && $totalPages > 1): ?>
        <nav class="pagination" aria-label="Phân trang">
            <?php if ($currentPage > 1): ?>
                <a class="btn ghost" href="<?= htmlspecialchars($pageUrl($currentPage - 1), ENT_QUOTES, 'UTF-8') ?>">
                    << /a>
                    <?php endif; ?> <!-- Hiển thị nút "Trước" nếu không phải trang đầu -->

                    <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                        <a
                            class="btn<?= $page === $currentPage ? ' primary' : ' ghost' ?>"
                            href="<?= htmlspecialchars($pageUrl($page), ENT_QUOTES, 'UTF-8') ?>"
                            aria-current="<?= $page === $currentPage ? 'page' : 'false' ?>"><?= $page ?></a>
                    <?php endfor; ?> <!-- Hiển thị các nút trang -->

                    <?php if ($currentPage < $totalPages): ?>
                        <a class="btn ghost" href="<?= htmlspecialchars($pageUrl($currentPage + 1), ENT_QUOTES, 'UTF-8') ?>">></a>
                    <?php endif; ?> <!-- Hiển thị nút "Tiếp" nếu không phải trang cuối -->
        </nav>
    <?php endif; ?>
</section>
