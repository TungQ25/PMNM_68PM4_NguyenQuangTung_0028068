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
        $this->render('sinhvien/create', [
            'pageTitle' => 'Thêm sinh viên',
        ]);
    }
}
