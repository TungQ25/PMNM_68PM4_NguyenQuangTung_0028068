<?php

declare(strict_types=1);

final class SinhvienController extends Controller
{
    public function index(): void
    {
        $this->render('sinhvien/index', [
            'pageTitle' => 'Danh sách sinh viên',
        ]);
    }

    public function create(): void
    {
        $error = '';
        $old = [
            'hoten' => '',
            'masv' => '',
        ];

        // Hiện tại đang lưu theo session tồn tại thời gian ngắn, chưa có database
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            $old['hoten'] = trim((string) ($_POST['hoten'] ?? ''));
            $old['masv'] = trim((string) ($_POST['masv'] ?? ''));

            if ($old['hoten'] === '' || $old['masv'] === '') {
                $error = 'Vui lòng nhập đầy đủ họ tên và mã sinh viên.';
            } else {
                $_SESSION['sinhvien'][] = [
                    'hoten' => $old['hoten'],
                    'masv' => $old['masv'],
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                $this->redirect('/sinhvien');
            }
        }

        $this->render('sinhvien/create', [
            'pageTitle' => 'Thêm sinh viên',
            'error' => $error,
            'old' => $old,
        ]);
    }
}
