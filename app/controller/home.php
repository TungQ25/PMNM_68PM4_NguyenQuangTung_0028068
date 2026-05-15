<?php

declare(strict_types=1);

final class HomeController extends Controller
{
    public function index(): void
    {
        $this->render('home/index', [
            'pageTitle' => 'Trang chủ',
        ]);
    }

    public function gioithieu(): void
    {
        $this->render('home/gioithieu', [
            'pageTitle' => 'Giới thiệu',
        ]);
    }
}
