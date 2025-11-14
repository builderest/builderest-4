<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Database;

class Setting extends Model
{
    protected string $table = 'settings';
    protected string $primaryKey = 'key';

    public function getValue(string $key, $default = null)
    {
        $stmt = Database::query('SELECT value FROM settings WHERE `key` = :key LIMIT 1', ['key' => $key]);
        $row = $stmt->fetch();
        return $row['value'] ?? $default;
    }

    public function setValue(string $key, $value): bool
    {
        $exists = $this->find($key);
        if ($exists) {
            $sql = 'UPDATE settings SET value = :value WHERE `key` = :key';
        } else {
            $sql = 'INSERT INTO settings (`key`, value) VALUES (:key, :value)';
        }

        return Database::query($sql, ['key' => $key, 'value' => $value])->rowCount() > 0;
    }
}
