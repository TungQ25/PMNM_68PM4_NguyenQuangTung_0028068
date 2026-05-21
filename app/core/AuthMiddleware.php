<?php

declare(strict_types=1);

final class AuthMiddleware
{
    private const PROTECTED_CONTROLLERS = [
        'home',
        'sinhvien',
    ];

    public static function handle(string $controller, string $action): bool
    {
        unset($action);

        if (!in_array($controller, self::PROTECTED_CONTROLLERS, true)) {
            return true;
        }

        if (!empty($_SESSION['user'])) {
            return true;
        }

        $base = defined('BASE_URL') ? BASE_URL : '';
        header('Location: ' . $base . '/auth/login');
        return false;
    }
}
