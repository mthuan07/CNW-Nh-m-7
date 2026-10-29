<?php
require_once __DIR__ . '/../models/Inventory.php';

class InventoryController extends Controller {
    public function index() {
        $products = Inventory::getAll();
        $this->view('inventory/index', ['products' => $products]);
    }
    
    public function edit() {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $product = Inventory::findById($id);
        if (!$product) {
            header("Location: index.php?controller=inventory&action=index");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Inventory::update($id, [
                'product_name' => $_POST['product_name'],
                'category'     => $_POST['category'],
                'unit'         => $_POST['unit'],
                'price'        => $_POST['price']
            ]);
            header("Location: index.php?controller=inventory&action=index");
            exit;
        }
        $this->view('inventory/edit', ['product' => $product]);
    }
    // Xử lý xóa sản phẩm
    public function delete() {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        if ($id > 0) {
            Inventory::delete($id);
        }
        header("Location: index.php?controller=inventory&action=index");
        exit;
    }
    // Xem chi tiết sản phẩm
    public function detail() {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $product = Inventory::findById($id);
        
        if (!$product) {
            header("Location: index.php?controller=inventory&action=index");
            exit;
        }
        
        // Gọi file view chi tiết riêng biệt
        $this->view('inventory/detail', ['product' => $product]);
    }
}