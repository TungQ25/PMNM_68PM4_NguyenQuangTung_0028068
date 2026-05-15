<?php

declare(strict_types=1);

define('ROOT_PATH', dirname(__DIR__));

$base = rtrim(str_replace('\\', '/', dirname((string) ($_SERVER['SCRIPT_NAME'] ?? ''))), '/');
define('BASE_URL', $base === '' ? '' : $base);

require_once ROOT_PATH . '/app/core/Controller.php';
require_once ROOT_PATH . '/app/core/App.php';
// Controller cụ thể được App require_once theo URL (giống mẫu).

(new App())->dispatch();
