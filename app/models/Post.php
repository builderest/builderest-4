<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Database;

class Post extends Model
{
    protected string $table = 'posts';

    public function latest(int $limit = 6): array
    {
        $limit = max(1, $limit);
        $stmt = Database::query('SELECT * FROM posts ORDER BY created_at DESC LIMIT ' . (int) $limit);
        return $stmt->fetchAll();
    }

    public function findBySlug(string $slug): ?array
    {
        return $this->findBy(['slug' => $slug]);
    }
}
