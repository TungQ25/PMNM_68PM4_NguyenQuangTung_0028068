<section class="card">
    <div class="card-header">
        <h1>Giới thiệu</h1>
        <a class="btn ghost" href="<?= htmlspecialchars((defined('BASE_URL') ? BASE_URL : '') . '/', ENT_QUOTES, 'UTF-8') ?>">Về trang chủ</a>
    </div>

    <p class="lead">
        Ứng dụng quản lý sinh viên hỗ trợ theo dõi danh sách sinh viên và lớp học trong một giao diện gọn, dễ thao tác.
    </p>

    <h2>Chức năng chính</h2>
    <ul class="checks">
        <li>Quản lý sinh viên: thêm, xem danh sách, cập nhật và xóa sinh viên.</li>
        <li>Quản lý lớp học: lưu mã lớp, tên lớp và danh sách lớp.</li>
        <li>Gán sinh viên vào lớp thông qua mã lớp.</li>
        <li>Tìm kiếm sinh viên theo MSSV, họ tên và lớp.</li>
        <li>Sắp xếp danh sách sinh viên theo MSSV hoặc họ tên.</li>
        <li>Tùy chọn số dòng hiển thị trên mỗi trang.</li>
    </ul>

    <h2>Mục tiêu</h2>
    <p class="muted">
        Hệ thống được xây dựng theo mô hình MVC bằng PHP, giúp tách riêng controller, model và giao diện. Cách tổ chức này giúp mã nguồn dễ bảo trì, dễ mở rộng thêm chức năng sau này.
    </p>
</section>
