<?php
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

$controller = $_GET['controller'] ?? 'sanpham';
$action = $_GET['action'] ?? 'index';

if ($controller == 'danhmuc') {
    require_once 'controllers/DanhMucController.php';
    $ctrl = new DanhMucController($db);
} else {
    require_once 'controllers/SanPhamController.php';
    $ctrl = new SanPhamController($db);
}

if (method_exists($ctrl, $action)) {
    $ctrl->$action();
} else {
    echo "Không tìm thấy hành động (action) phù hợp!";
}
?>