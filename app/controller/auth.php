<?php

declare(strict_types=1);

final class AuthController extends Controller
{
    private const USERS = [
        'admin' => '123456',
        'tung' => '123456',
    ];

    public function login(): void
    {
        if (!empty($_SESSION['user'])) {
            $this->redirect('/');
        }

        $error = '';

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            $username = trim((string) ($_POST['username'] ?? ''));
            $password = (string) ($_POST['password'] ?? '');

            if (isset(self::USERS[$username]) && self::USERS[$username] === $password) {
                session_regenerate_id(true);
                $_SESSION['user'] = [
                    'username' => $username,
                ];

                $this->redirect('/');
            }

            $error = 'Sai tên đăng nhập hoặc tài khoản';
        }

        $this->render('auth/login', [
            'pageTitle' => 'Đăng nhập',
            'error' => $error,
        ]);
    }

    public function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                (bool) $params['secure'],
                (bool) $params['httponly']
            );
        }

        session_destroy();
        $this->redirect('/auth/login');
    }
}
