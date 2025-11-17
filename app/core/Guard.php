<?php
namespace App\Core;

class Guard
{
    public static function requireAdmin(): bool
    {
        if (!Auth::check()) {
            header('Location: /admin/login');
            return false;
        }

        return true;
    }

    public static function requireRole(string $role): bool
    {
        if (!self::requireAdmin()) {
            return false;
        }

        $user = Auth::user();
        if (!$user || $user['role'] !== $role) {
            header('Location: /admin');
            return false;
        }

        return true;
    }
}
