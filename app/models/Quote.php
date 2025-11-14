<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Database;

class Quote extends Model
{
    protected string $table = 'quotes';

    public function latest(int $limit = 5): array
    {
        $stmt = Database::query('SELECT * FROM quotes ORDER BY created_at DESC LIMIT ' . (int) $limit);
        return $stmt->fetchAll();
    }
}
