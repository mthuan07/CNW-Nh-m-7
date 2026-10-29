<?php
// File này có thể dùng để hiển thị giao diện xác nhận xóa hoặc xử lý trực tiếp
require_once __DIR__ . '/../../models/Inventory.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
if ($id > 0) {
    Inventory::delete($id);
}
header("Location: index.php?controller=inventory&action=index");
exit;