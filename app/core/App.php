<?php

declare(strict_types=1); // bật strict types để kiểm tra chặt hơn

final class App
{
    private const DEFAULT_CONTROLLER = 'home';
    private const DEFAULT_ACTION = 'index';

    /** Map URL slug sang class controller */
    private const CONTROLLER_CLASSES = [
        'home' => HomeController::class,
        'sinhvien' => SinhvienController::class,
    ];

    public function dispatch(): void
    {
        $urlProcessed = $this->urlProcess(); // mảng URL đã được xử lý
        $rest = $urlProcessed;

        $controllerSlug = self::DEFAULT_CONTROLLER; 
        // Kiểm tra phần đầu URL có phải controller không
        if (isset($urlProcessed[0]) && $urlProcessed[0] !== '') {
            $candidate = strtolower((string) $urlProcessed[0]);
            $file = ROOT_PATH . '/app/controller/' . $candidate . '.php';
            if (is_file($file)) {
                $controllerSlug = $candidate;
                unset($rest[0]);
            }
        }

        require_once ROOT_PATH . '/app/controller/' . $controllerSlug . '.php';

        // Đảm bảo quay về home nếu có class lỗi hoặc ko tồn tại
        $class = self::CONTROLLER_CLASSES[$controllerSlug] ?? null;
        if ($class === null || !class_exists($class)) {
            // File tồn tại nhưng chưa khai báo class — an toàn quay về home
            $controllerSlug = self::DEFAULT_CONTROLLER;
            $rest = $urlProcessed;
            require_once ROOT_PATH . '/app/controller/' . $controllerSlug . '.php';
            $class = self::CONTROLLER_CLASSES[$controllerSlug];
        }

        $controller = new $class();

        $action = self::DEFAULT_ACTION;
        // Kiểm tra xem có action hợp lệ ko
        if (isset($urlProcessed[1]) && $urlProcessed[1] !== '') {
            $candidateAction = $this->sanitizeAction((string) $urlProcessed[1]);
            // Tên action không rỗng và method  có thể gọi được
            if ($candidateAction !== '' && $this->actionCallable($controller, $candidateAction)) {
                $action = $candidateAction;
                unset($rest[1]);
            }
        }

        $params = $rest ? array_values($rest) : [];

        $this->invokeAction($controller, $action, $params);
    }

    /**
     * @return list<string>
     */
    private function urlProcess(): array
    {
        // Nếu .htaccess truyền URL vào biến url thì dùng 
        if (isset($_GET['url'])) {
            $raw = trim((string) $_GET['url'], '/'); // xóa dấu / ở đầu và cuối
            return $raw === '' ? [] : explode('/', $raw); // tách mảng theo dấu /
        }

        // Nếu không có $_GET['url'] thì dùng URI
        $path = $this->requestPath();
        return $path === '' ? [] : explode('/', $path);
    }

    private function requestPath(): string
    {
        $uri = (string) (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/');
        $base = rtrim(str_replace('\\', '/', dirname((string) ($_SERVER['SCRIPT_NAME'] ?? ''))), '/');
        if ($base !== '' && strncmp($uri, $base, strlen($base)) === 0) {
            $uri = substr($uri, strlen($base)) ?: '/';
        }

        return trim($uri, '/');
    }

    private function sanitizeAction(string $raw): string
    {
        $raw = strtolower($raw);
        if ($raw === '' || !preg_match('/^[a-z][a-z0-9_]*$/', $raw)) {
            return '';
        }

        return $raw;
    }

    private function actionCallable(object $controller, string $action): bool
    {
        if (!method_exists($controller, $action)) {
            return false;
        }
        $ref = new ReflectionMethod($controller, $action);
        if (!$ref->isPublic() || $ref->isStatic()) {
            return false;
        }

        return $ref->getDeclaringClass()->getName() === get_class($controller);
    }

    /**
     * Gọi action; chỉ truyền đúng số tham số method nhận (tránh lỗi arity PHP 8+).
     *
     * @param list<string> $params
     */
    private function invokeAction(object $controller, string $action, array $params): void
    {
        $ref = new ReflectionMethod($controller, $action);
        $count = $ref->getNumberOfParameters();
        $toPass = array_slice($params, 0, $count);
        call_user_func_array([$controller, $action], $toPass);
    }
}
