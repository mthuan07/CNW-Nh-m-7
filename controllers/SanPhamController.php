<?php
require_once 'models/SanPham.php';
require_once 'models/DanhMuc.php';

class SanPhamController {
    private $db;
    private $sanPham;
    private $danhMuc;

    public function __construct($db) {
        $this->db = $db;
        $this->sanPham = new SanPham($db);
        $this->danhMuc = new DanhMuc($db);
    }

    public function index() {
        $result = $this->sanPham->getAll();
        include 'views/sanpham/index.php';
    }

    public function create() {
        $danhmucs = $this->danhMuc->getAll();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten = $_POST['ten_san_pham'];
            $gia = $_POST['gia'];
            $soluong = $_POST['so_luong'];
            $mota = $_POST['mo_ta'];
            $danhmucid = $_POST['danh_muc_id'];

            if ($this->sanPham->create($ten, $gia, $soluong, $mota, $danhmucid)) {
                header("Location: index.php?controller=sanpham&action=index");
                exit();
            }
        }
        include 'views/sanpham/create.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
        $row = $this->sanPham->getById($id);
        $danhmucs = $this->danhMuc->getAll();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten = $_POST['ten_san_pham'];
            $gia = $_POST['gia'];
            $soluong = $_POST['so_luong'];
            $mota = $_POST['mo_ta'];
            $danhmucid = $_POST['danh_muc_id'];

            if ($this->sanPham->update($id, $ten, $gia, $soluong, $mota, $danhmucid)) {
                header("Location: index.php?controller=sanpham&action=index");
                exit();
            }
        }
        include 'views/sanpham/edit.php';
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        $this->sanPham->delete($id);
        header("Location: index.php?controller=sanpham&action=index");
        exit();
    }
}
?>