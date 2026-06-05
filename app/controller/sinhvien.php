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
        $this->render('sinhvien/index', [
            'pageTitle' => 'Danh sách sinh viên',
            'sinhvien' => $this->model()->all(),
        ]);
    }

    public function create(): void
    {
        $error = '';
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
                    $this->redirect('/sinhvien');
                } catch (PDOException $exception) {
                    unset($exception);
                    $error = 'Không thể thêm sinh viên. Vui lòng thử lại.';
                }
            }
        }

        $this->render('sinhvien/create', [
            'pageTitle' => 'Thêm sinh viên',
            'error' => $error,
            'old' => $old,
        ]);
    }
}
