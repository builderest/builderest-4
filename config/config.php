<?php
use App\Core\Database;

$envFile = __DIR__ . '/../.env';
if (!file_exists($envFile)) {
    throw new RuntimeException('.env file is missing.');
}

$env = parse_ini_file($envFile, false, INI_SCANNER_TYPED);

foreach ($env as $key => $value) {
    if (!defined($key)) {
        define($key, $value);
    }
}

date_default_timezone_set(APP_TIMEZONE ?? 'UTC');

Database::init([
    'host' => DB_HOST,
    'port' => DB_PORT,
    'dbname' => DB_NAME,
    'username' => DB_USER,
    'password' => DB_PASS,
    'charset' => DB_CHARSET,
]);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function env(string $key, $default = null)
{
    return defined($key) ? constant($key) : ($default ?? null);
}

function asset(string $path): string
{
    return rtrim(APP_URL, '/') . '/' . ltrim($path, '/');
}

function url(string $path = ''): string
{
    return rtrim(APP_URL, '/') . '/' . ltrim($path, '/');
}

function setting(string $key, $default = null)
{
    static $cache = [];

    if (array_key_exists($key, $cache)) {
        return $cache[$key];
    }

    $model = new App\Models\Setting();
    $value = $model->getValue($key, $default);
    $cache[$key] = $value;
    return $value;
}
