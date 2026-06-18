<?php
$base = defined('BASE_URL') ? BASE_URL : '';

if (!isset($lophoc) || !is_array($lophoc)) {
    $lophoc = [];
}

$currentPage = isset($currentPage) ? (int) $currentPage : 1;
$totalPages = isset($totalPages) ? (int) $totalPages : 1;
$totalRows = isset($totalRows) ? (int) $totalRows : count($lophoc);
$offset = isset($offset) ? (int) $offset : 0;

$pageUrl = static function (int $page) use ($base): string {
    return $base . '/lophoc?page=' . $page;
};
?>
<section class="card">
    <h1>Danh sách lớp học</h1>
    <p>
        <a class="btn primary" href="<?= htmlspecialchars($base . '/lophoc/create', ENT_QUOTES, 'UTF-8') ?>">Thêm lớp học</a>
    </p>

    <div class="placeholder-table">
        <?php if ($lophoc === []): ?>
            <p><em>Chưa có dữ liệu.</em></p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã lớp</th>
                        <th>Tên lớp</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lophoc as $index => $lop): ?>
                        <?php $id = (int) ($lop['id'] ?? 0); ?>
                        <tr>
                            <td><?= $offset + $index + 1 ?></td>
                            <td><?= htmlspecialchars((string) ($lop['malop'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars((string) ($lop['tenlop'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars((string) ($lop['created_at'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <div class="table-actions">
                                    <a class="btn ghost" href="<?= htmlspecialchars($base . '/lophoc/edit/' . $id, ENT_QUOTES, 'UTF-8') ?>">Sửa</a>
                                    <form method="post" action="<?= htmlspecialchars($base . '/lophoc/delete/' . $id, ENT_QUOTES, 'UTF-8') ?>" onsubmit="return confirm('ạn có chắc muốn xóa lớp học này?');">
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
        <nav class="pagination" aria-label="Phan trang">
            <?php if ($currentPage > 1): ?>
                <a class="btn ghost" href="<?= htmlspecialchars($pageUrl($currentPage - 1), ENT_QUOTES, 'UTF-8') ?>">&lt;</a>
            <?php endif; ?>

            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                <a
                    class="btn<?= $page === $currentPage ? ' primary' : ' ghost' ?>"
                    href="<?= htmlspecialchars($pageUrl($page), ENT_QUOTES, 'UTF-8') ?>"
                    aria-current="<?= $page === $currentPage ? 'page' : 'false' ?>"><?= $page ?></a>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a class="btn ghost" href="<?= htmlspecialchars($pageUrl($currentPage + 1), ENT_QUOTES, 'UTF-8') ?>">&gt;</a>
            <?php endif; ?>
        </nav>
    <?php endif; ?>
</section>
