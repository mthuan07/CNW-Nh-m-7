<?php
require_once __DIR__ . '/../config/database.php';

class Database {
    private static $connection = null;
    
    public static function getConnection() {
        if (self::$connection === null) {
            self::$connection = new mysqli(
                DatabaseConfig::HOST,
                DatabaseConfig::USER,
                DatabaseConfig::PASS,
                DatabaseConfig::DB_NAME
            );
            if (self::$connection->connect_error) {
                die("Lỗi kết nối CSDL: " . self::$connection->connect_error);
            }
            self::$connection->set_charset("utf8mb4");
        }
        return self::$connection;
    }
}