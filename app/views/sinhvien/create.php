<section class="card">
    <h1>Thêm sinh viên</h1>
    <p class="muted">Route: <code>/sinhvien/create</code></p>
    <form class="form" method="post" action="#">
        <label>
            Họ tên
            <input type="text" name="hoten" placeholder="Nguyễn Văn A" autocomplete="name">
        </label>
        <label>
            Mã SV
            <input type="text" name="masv" placeholder="SV001">
        </label>
        <div class="form-actions">
            <!-- TODO: Thêm logic lưu sinh viên, mới chỉ có bản demo chưa hoạt động -->
            <button type="button" class="btn" disabled>Lưu (demo)</button> 
            <a class="btn ghost" href="<?= htmlspecialchars((defined('BASE_URL') ? BASE_URL : '') . '/sinhvien', ENT_QUOTES, 'UTF-8') ?>">Quay lại danh sách</a>
        </div>
    </form>
</section>
