<?php
class Database {
    private static ?PDO $conn = null;
    private static string $host = '127.0.0.1';
    private static string $db   = 'parcial3_db';
    private static string $user = 'root';
    private static string $pass = '';

    public static function getConnection(): PDO {
        if (self::$conn === null) {
            self::$conn = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=utf8mb4",
                self::$user,
                self::$pass,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }
        return self::$conn;
    }

    public static function query(string $sql, array $params = []): PDOStatement {
        $stmt = self::getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function lastInsertId(): string {
        return self::getConnection()->lastInsertId();
    }
}
