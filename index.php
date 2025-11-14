<?php
require_once __DIR__ . '/vendor/autoload.php';

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/app/';

    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

use App\Core\App;
use App\Core\Router;

require_once __DIR__ . '/config/config.php';

$router = new Router();

require __DIR__ . '/config/routes.php';

$app = new App($router);

$app->registerMiddleware('auth', function () {
    if (!isset($_SESSION['admin_id'])) {
        header('Location: /admin/login');
        return false;
    }
    return true;
});

$app->run();
