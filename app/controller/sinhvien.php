<?php

declare(strict_types=1);

require_once ROOT_PATH . '/app/models/Sinhvien.php';

final class SinhvienController extends Controller
{
    private ?Sinhvien $sinhvien = null;

    private function model(): Sinhvien
    {
        if (!$this->sinhvien instanceof Sinhvien) {
            $this->sinhvien = new Sinhvien(Database::connection());
        }

        return $this->sinhvien;
    }

    public function index(): void
    {
        $perPage = 5;
        $totalRows = $this->model()->countAll();
        $totalPages = max(1, (int) ceil($totalRows / $perPage)); 
        $currentPage = max(1, (int) ($_GET['page'] ?? 1)); 
        $currentPage = min($currentPage, $totalPages); 
        $offset = ($currentPage - 1) * $perPage; 

        $this->render('sinhvien/index', [ // Render view index.php trong thư mục sinhvien
            'pageTitle' => 'Danh sách sinh viên',
            'sinhvien' => $this->model()->paginate($perPage, $offset), // Lấy dữ liệu sinh viên theo trang, gọi hàm paginate trong model để chạy SQL
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'totalRows' => $totalRows,
            'offset' => $offset,
        ]);
    }

    public function create(): void
    {
        $error = '';
        $success = '';
        $old = [
            'hoten' => '',
            'masv' => '',
        ];

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            $old['hoten'] = trim((string) ($_POST['hoten'] ?? ''));
            $old['masv'] = trim((string) ($_POST['masv'] ?? ''));

            if ($old['hoten'] === '' || $old['masv'] === '') {
                $error = 'Vui lòng nhập đầy đủ họ tên và mã sinh viên.';
            } elseif ($this->model()->existsByMasv($old['masv'])) {
                $error = 'Mã sinh viên đã tồn tại.';
            } else {
                try {
                    $this->model()->create($old['hoten'], $old['masv']);
                    $success = 'Thêm sinh viên thành công.';
                    $old = [
                        'hoten' => '',
                        'masv' => '',
                    ];
                } catch (PDOException $exception) {
                    unset($exception);
                    $error = 'Không thể thêm sinh viên. Vui lòng thử lại.';
                }
            }
        }

        $this->render('sinhvien/create', [
            'pageTitle' => 'Thêm sinh viên',
            'error' => $error,
            'success' => $success,
            'old' => $old,
        ]);
    }
}
