<?php
class Customer {
    public static function getAll() {
        $db = Database::getConnection();
        $result = $db->query("SELECT * FROM customers ORDER BY id DESC");
        $rows = [];
        if ($result) { while ($row = $result->fetch_assoc()) { $rows[] = $row; } }
        return $rows;
    }
}