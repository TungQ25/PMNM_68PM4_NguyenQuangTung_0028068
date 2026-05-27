<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('ROOT_PATH', dirname(__DIR__));

$scriptDir = rtrim(str_replace('\\', '/', dirname((string) ($_SERVER['SCRIPT_NAME'] ?? ''))), '/');
$base = $scriptDir === '/public' ? '' : $scriptDir;

define('BASE_URL', $base === '' ? '' : $base);

require_once ROOT_PATH . '/app/core/Controller.php';
require_once ROOT_PATH . '/app/core/Database.php';
require_once ROOT_PATH . '/app/core/AuthMiddleware.php';
require_once ROOT_PATH . '/app/core/App.php';

(new App())->dispatch();
