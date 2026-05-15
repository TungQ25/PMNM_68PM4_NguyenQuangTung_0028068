<section class="card">
    <h1>Danh sách sinh viên</h1>
    <p class="muted">Route: <code>/sinhvien</code> — trang index của module sinh viên.</p>
    <p>
        <a class="btn primary" href="<?= htmlspecialchars((defined('BASE_URL') ? BASE_URL : '') . '/sinhvien/create', ENT_QUOTES, 'UTF-8') ?>">Thêm sinh viên</a>
    </p>
    <div class="placeholder-table">
        <!-- TODO: Thêm logic hiển thị danh sách sinh viên, mới chỉ có bản demo chưa hoạt động -->
        <p><em>Chưa có dữ liệu — giao diện mẫu.</em></p>
    </div>
</section>
