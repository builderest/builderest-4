<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Database;

class Faq extends Model
{
    protected string $table = 'faqs';

    public function latest(int $limit = 8): array
    {
        $stmt = Database::query('SELECT * FROM faqs ORDER BY created_at DESC LIMIT ' . (int) $limit);
        return $stmt->fetchAll();
    }
}
