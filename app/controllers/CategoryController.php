<?php
require_once 'models/Category.php';

class CategoryController {
    private $db;
    private $category;

    public function __construct($db) {
        $this->db = $db;
        $this->category = new Category($db);
    }

    public function index() {
        $result = $this->category->getAll();
        include 'views/categories/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            if ($this->category->create($name, $description)) {
                header("Location: index.php?controller=category&action=index");
                exit();
            }
        }
        include 'views/categories/create.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
        $row = $this->category->getById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            if ($this->category->update($id, $name, $description)) {
                header("Location: index.php?controller=category&action=index");
                exit();
            }
        }
        include 'views/categories/edit.php';
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        if (!$this->category->delete($id)) {
            echo "<script>alert('Không thể xóa vì danh mục này còn chứa sản phẩm!'); window.location='index.php?controller=category&action=index';</script>";
        } else {
            header("Location: index.php?controller=category&action=index");
            exit();
        }
    }
}
?>