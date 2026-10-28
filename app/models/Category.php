<?php
class Category {
    private $conn;
    private $table_name = "danh_muc";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($name, $description) {
        $query = "INSERT INTO " . $this->table_name . " (ten_danh_muc, mo_ta) VALUES (:name, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $description) {
        $query = "UPDATE " . $this->table_name . " SET ten_danh_muc = :name, mo_ta = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function delete($id) {
        // Kiểm tra xem danh mục còn sản phẩm không (chặn xóa nếu còn)
        $check_query = "SELECT COUNT(*) as total FROM san_pham WHERE danh_muc_id = ?";
        $check_stmt = $this->conn->prepare($check_query);
        $check_stmt->bindParam(1, $id);
        $check_stmt->execute();
        $row = $check_stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['total'] > 0) {
            return false; // Còn sản phẩm, không cho xóa
        }

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }
}
?>