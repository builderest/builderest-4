<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Database;

class User extends Model
{
    protected string $table = 'users';

    public function findByEmail(string $email): ?array
    {
        return $this->findBy(['email' => $email]);
    }

    public function setResetToken(int $id, string $token, string $expiresAt): bool
    {
        $sql = 'UPDATE users SET reset_token = :token, reset_expires_at = :expires WHERE id = :id';
        return Database::query($sql, [
            'token' => $token,
            'expires' => $expiresAt,
            'id' => $id,
        ])->rowCount() > 0;
    }

    public function updatePassword(int $id, string $password): bool
    {
        $sql = 'UPDATE users SET password = :password, reset_token = NULL, reset_expires_at = NULL WHERE id = :id';
        return Database::query($sql, [
            'password' => $password,
            'id' => $id,
        ])->rowCount() > 0;
    }

    public function findByToken(string $token): ?array
    {
        $stmt = Database::query('SELECT * FROM users WHERE reset_token = :token LIMIT 1', ['token' => $token]);
        $result = $stmt->fetch();
        return $result ?: null;
    }
}
