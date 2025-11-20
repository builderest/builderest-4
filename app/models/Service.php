<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Database;

class Service extends Model
{
    protected string $table = 'services';

    public function findBySlug(string $slug): ?array
    {
        return $this->findBy(['slug' => $slug]);
    }

    public function allOrdered(): array
    {
        $stmt = Database::query('SELECT * FROM services ORDER BY name ASC');
        return $stmt->fetchAll();
    }

    public function byCategory(string $category): array
    {
        $stmt = Database::query('SELECT * FROM services WHERE category = :category ORDER BY name ASC', ['category' => $category]);
        return $stmt->fetchAll();
    }
}
