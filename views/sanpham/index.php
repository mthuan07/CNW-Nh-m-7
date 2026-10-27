<?php include 'views/layouts/header.php'; ?>
<h2>Quản lý Sản Phẩm</h2>
<a href="index.php?controller=sanpham&action=create" class="btn btn-primary mb-3">+ Thêm sản phẩm</a>
<table class="table table-bordered">
    <tr><th>ID</th><th>Tên sản phẩm</th><th>Giá</th><th>Số lượng</th><th>Danh mục</th><th>Mô tả</th><th>Thao tác</th></tr>
    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['ten_san_pham']) ?></td>
        <td><?= number_format($row['gia']) ?> đ</td>
        <td><?= $row['so_luong'] ?></td>
        <td><?= htmlspecialchars($row['ten_danh_muc']) ?></td>
        <td><?= htmlspecialchars($row['mo_ta']) ?></td>
        <td>
            <a href="index.php?controller=sanpham&action=edit&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
            <a href="index.php?controller=sanpham&action=delete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
        </td>
    </tr>
    <?php } ?>
</table>
<?php include 'views/layouts/footer.php'; ?>