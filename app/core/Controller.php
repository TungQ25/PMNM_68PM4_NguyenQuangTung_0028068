<?php

declare(strict_types=1);

class Controller
{
    protected function redirect(string $path): void
    {
        $base = defined('BASE_URL') ? BASE_URL : '';
        header('Location: ' . $base . $path);
        exit;
    }

    protected function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $viewPath = ROOT_PATH . '/app/views/' . $view . '.php';
        if (!is_file($viewPath)) {
            http_response_code(500);
            echo 'Không tìm thấy view: ' . htmlspecialchars($view, ENT_QUOTES, 'UTF-8');
            return;
        }
        ob_start();
        require $viewPath;
        $content = ob_get_clean();
        $pageTitle = $data['pageTitle'] ?? 'Ứng dụng';
        require ROOT_PATH . '/app/views/layout.php';
    }
}
