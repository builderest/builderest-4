<?php
namespace App\Core;

class Auth
{
    public static function login(array $user): void
    {
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_name'] = $user['name'] ?? 'Administrator';
        $_SESSION['admin_role'] = $user['role'] ?? 'editor';
    }

    public static function logout(): void
    {
        $_SESSION = [];
        if (session_status() === PHP_SESSION_ACTIVE && ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
    }

    public static function check(): bool
    {
        return isset($_SESSION['admin_id']);
    }

    public static function user(): ?array
    {
        if (!self::check()) {
            return null;
        }

        return [
            'id' => (int) ($_SESSION['admin_id'] ?? 0),
            'name' => $_SESSION['admin_name'] ?? 'Administrator',
            'role' => $_SESSION['admin_role'] ?? 'editor',
        ];
    }
}
