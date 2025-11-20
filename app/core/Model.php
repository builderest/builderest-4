<?php
namespace App\Core;

use App\Core\Database;
use PDOStatement;

abstract class Model
{
    protected string $table;
    protected string $primaryKey = 'id';

    public function all(): array
    {
        $stmt = Database::query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    public function find($id): ?array
    {
        $stmt = Database::query("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id LIMIT 1", ['id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function findBy(array $conditions): ?array
    {
        $fields = [];
        foreach ($conditions as $field => $value) {
            $fields[] = "{$field} = :{$field}";
        }
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . implode(' AND ', $fields) . ' LIMIT 1';
        $stmt = Database::query($sql, $conditions);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function create(array $data): bool
    {
        $columns = array_keys($data);
        $placeholders = array_map(fn($col) => ':' . $col, $columns);
        $sql = 'INSERT INTO ' . $this->table . ' (' . implode(',', $columns) . ') VALUES (' . implode(',', $placeholders) . ')';
        return Database::query($sql, $data)->rowCount() > 0;
    }

    public function update($id, array $data): bool
    {
        $set = [];
        foreach ($data as $column => $value) {
            $set[] = "{$column} = :{$column}";
        }
        $data[$this->primaryKey] = $id;
        $sql = 'UPDATE ' . $this->table . ' SET ' . implode(',', $set) . ' WHERE ' . $this->primaryKey . ' = :' . $this->primaryKey;
        return Database::query($sql, $data)->rowCount() >= 0;
    }

    public function delete($id): bool
    {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $this->primaryKey . ' = :id';
        return Database::query($sql, ['id' => $id])->rowCount() > 0;
    }
}
