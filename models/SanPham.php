<?php
class SanPham {
    private $conn;
    private $table_name = "san_pham";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT sp.*, dm.ten_danh_muc FROM " . $this->table_name . " sp LEFT JOIN danh_muc dm ON sp.danh_muc_id = dm.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($ten_san_pham, $gia, $so_luong, $mo_ta, $danh_muc_id) {
        $query = "INSERT INTO " . $this->table_name . " (ten_san_pham, gia, so_luong, mo_ta, danh_muc_id) VALUES (:ten_san_pham, :gia, :so_luong, :mo_ta, :danh_muc_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ten_san_pham", $ten_san_pham);
        $stmt->bindParam(":gia", $gia);
        $stmt->bindParam(":so_luong", $so_luong);
        $stmt->bindParam(":mo_ta", $mo_ta);
        $stmt->bindParam(":danh_muc_id", $danh_muc_id);
        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $ten_san_pham, $gia, $so_luong, $mo_ta, $danh_muc_id) {
        $query = "UPDATE " . $this->table_name . " SET ten_san_pham = :ten_san_pham, gia = :gia, so_luong = :so_luong, mo_ta = :mo_ta, danh_muc_id = :danh_muc_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ten_san_pham", $ten_san_pham);
        $stmt->bindParam(":gia", $gia);
        $stmt->bindParam(":so_luong", $so_luong);
        $stmt->bindParam(":mo_ta", $mo_ta);
        $stmt->bindParam(":danh_muc_id", $danh_muc_id);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }
}
?>