<?php
require_once 'models/DanhMuc.php';

class DanhMucController {
    private $db;
    private $danhMuc;

    public function __construct($db) {
        $this->db = $db;
        $this->danhMuc = new DanhMuc($db);
    }

    public function index() {
        $result = $this->danhMuc->getAll();
        include 'views/danhmuc/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten = $_POST['ten_danh_muc'];
            $mota = $_POST['mo_ta'];
            if ($this->danhMuc->create($ten, $mota)) {
                header("Location: index.php?controller=danhmuc&action=index");
                exit();
            }
        }
        include 'views/danhmuc/create.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
        $row = $this->danhMuc->getById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten = $_POST['ten_danh_muc'];
            $mota = $_POST['mo_ta'];
            if ($this->danhMuc->update($id, $ten, $mota)) {
                header("Location: index.php?controller=danhmuc&action=index");
                exit();
            }
        }
        include 'views/danhmuc/edit.php';
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        if (!$this->danhMuc->delete($id)) {
            echo "<script>alert('Không thể xóa vì danh mục này còn chứa sản phẩm!'); window.location='index.php?controller=danhmuc&action=index';</script>";
        } else {
            header("Location: index.php?controller=danhmuc&action=index");
            exit();
        }
    }
}
?>