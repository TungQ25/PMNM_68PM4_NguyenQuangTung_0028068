<?php

declare(strict_types=1);

final class HomeController extends Controller
{
    public function index(): void
    {
        $this->render('home/index', [
            'pageTitle' => 'Trang Chủ',
            'username' => $_SESSION['user']['username'] ?? '',
        ]);
    }

    public function gioithieu(): void
    {
        $this->render('home/gioithieu', [
            'pageTitle' => 'Giới thiệu',
        ]);
    }
}
