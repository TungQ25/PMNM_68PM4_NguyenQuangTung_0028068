<?php
$base = defined('BASE_URL') ? BASE_URL : '';

if (!isset($sinhvien) || !is_array($sinhvien)) {
    $sinhvien = [];
}

$filters = isset($filters) && is_array($filters) ? $filters : [
    'masv' => '',
    'hoten' => '',
    'malop' => '',
];
$lophoc = isset($lophoc) && is_array($lophoc) ? $lophoc : [];
$currentPage = isset($currentPage) ? (int) $currentPage : 1;
$totalPages = isset($totalPages) ? (int) $totalPages : 1;
$totalRows = isset($totalRows) ? (int) $totalRows : count($sinhvien);
$offset = isset($offset) ? (int) $offset : 0;

$pageUrl = static function (int $page) use ($base, $filters): string {
    $query = array_filter([
        'masv' => (string) ($filters['masv'] ?? ''),
        'hoten' => (string) ($filters['hoten'] ?? ''),
        'malop' => (string) ($filters['malop'] ?? ''),
        'page' => $page,
    ], static fn (string|int $value): bool => (string) $value !== '');

    return $base . '/sinhvien?' . http_build_query($query);
};
?>
<section class="card">
    <div class="card-header">
        <h1>Danh sách sinh viên</h1>
        <a class="btn primary" href="<?= htmlspecialchars($base . '/sinhvien/create', ENT_QUOTES, 'UTF-8') ?>">Th&ecirc;m sinh vi&ecirc;n</a>
    </div>

    <form class="search-form" method="get" action="<?= htmlspecialchars($base . '/sinhvien', ENT_QUOTES, 'UTF-8') ?>">
        <div class="search-field">
            <label for="search-masv">MSSV</label>
            <input class="search-control" id="search-masv" type="text" name="masv" placeholder="SV001" value="<?= htmlspecialchars((string) ($filters['masv'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
        </div>

        <div class="search-field">
            <label for="search-hoten">Họ tên</label>
            <input class="search-control" id="search-hoten" type="text" name="hoten" placeholder="Nguyen Van A" value="<?= htmlspecialchars((string) ($filters['hoten'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
        </div>

        <div class="search-field">
            <label for="search-malop">Lớp</label>
            <select class="search-control" id="search-malop" name="malop">
                <option value="">Tất cả lớp</option>
                <?php foreach ($lophoc as $lop): ?>
                    <?php $malop = (string) ($lop['malop'] ?? ''); ?>
                    <option value="<?= htmlspecialchars($malop, ENT_QUOTES, 'UTF-8') ?>"<?= $malop === (string) ($filters['malop'] ?? '') ? ' selected' : '' ?>>
                        <?= htmlspecialchars($malop . ' - ' . (string) ($lop['tenlop'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="search-actions">
            <button type="submit" class="btn primary">Tìm kiếm</button>
            <a class="btn ghost" href="<?= htmlspecialchars($base . '/sinhvien', ENT_QUOTES, 'UTF-8') ?>">Xóa lọc</a>
        </div>
    </form>

    <div class="placeholder-table">
        <?php if ($sinhvien === []): ?>
            <p><em>Không tìm thấy sinh viên phù hợp.</em></p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ tên</th>
                        <th>Mã SV</th>
                        <th>Lớp</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sinhvien as $index => $sv): ?>
                        <?php $id = (int) ($sv['id'] ?? 0); ?>
                        <tr>
                            <td><?= $offset + $index + 1 ?></td>
                            <td><?= htmlspecialchars((string) ($sv['hoten'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars((string) ($sv['masv'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars((string) ($sv['malop'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars((string) ($sv['created_at'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <div class="table-actions">
                                    <a class="btn ghost" href="<?= htmlspecialchars($base . '/sinhvien/edit/' . $id, ENT_QUOTES, 'UTF-8') ?>">Sửa</a>
                                    <form method="post" action="<?= htmlspecialchars($base . '/sinhvien/delete/' . $id, ENT_QUOTES, 'UTF-8') ?>" onsubmit="return confirm('ạn có chắc muốn xóa sinh viên này?');">
                                        <button type="submit" class="btn danger">Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <?php if ($totalRows > 0 && $totalPages > 1): ?>
        <nav class="pagination" aria-label="Phân trang">
            <?php if ($currentPage > 1): ?>
                <a class="btn ghost" href="<?= htmlspecialchars($pageUrl($currentPage - 1), ENT_QUOTES, 'UTF-8') ?>">&lt;</a>
            <?php endif; ?> <!-- Hiển thị nút "Trước" nếu không phải trang đầu -->

            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                <a
                    class="btn<?= $page === $currentPage ? ' primary' : ' ghost' ?>"
                    href="<?= htmlspecialchars($pageUrl($page), ENT_QUOTES, 'UTF-8') ?>"
                    aria-current="<?= $page === $currentPage ? 'page' : 'false' ?>"><?= $page ?></a>
            <?php endfor; ?> <!-- Hiển thị các nút trang -->

            <?php if ($currentPage < $totalPages): ?>
                <a class="btn ghost" href="<?= htmlspecialchars($pageUrl($currentPage + 1), ENT_QUOTES, 'UTF-8') ?>">&gt;</a>
            <?php endif; ?> <!-- Hiển thị nút "Tiếp" nếu không phải trang cuối -->
        </nav>
    <?php endif; ?>
</section>
