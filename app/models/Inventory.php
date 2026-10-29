<?php
class Inventory {
    public static function getAll() {
        $db = Database::getConnection();
        $result = $db->query("SELECT * FROM inventory ORDER BY id DESC");
        $rows = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) { $rows[] = $row; }
        }
        return $rows;
    }
    
    public static function findById($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM inventory WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public static function update($id, $data) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE inventory SET product_name = ?, category = ?, unit = ?, price = ? WHERE id = ?");
        $stmt->bind_param("sssii", $data['product_name'], $data['category'], $data['unit'], $data['price'], $id);
        return $stmt->execute();
    }
    // Xóa sản phẩm theo ID (chỉ xóa khi chưa có liên quan hoặc theo yêu cầu)
    public static function delete($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM inventory WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}