<?php
namespace App\Core;

use PDO;
use PDOException;
use PDOStatement;

class Database
{
    private static ?PDO $instance = null;
    private static array $config = [];

    public static function init(array $config): void
    {
        self::$config = $config;
    }

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            if (empty(self::$config)) {
                throw new PDOException('Database configuration has not been initialized.');
            }

            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                self::$config['host'] ?? 'localhost',
                self::$config['port'] ?? '3306',
                self::$config['dbname'] ?? '',
                self::$config['charset'] ?? 'utf8mb4'
            );

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            self::$instance = new PDO(
                $dsn,
                self::$config['username'] ?? '',
                self::$config['password'] ?? '',
                $options
            );
        }

        return self::$instance;
    }

    public static function query(string $sql, array $params = []): PDOStatement
    {
        $pdo = self::getInstance();
        $stmt = $pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $param = is_int($key) ? $key + 1 : (str_starts_with((string) $key, ':') ? (string) $key : ':' . $key);
            $stmt->bindValue($param, $value);
        }

        $stmt->execute();
        return $stmt;
    }
}
