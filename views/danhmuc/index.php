<?php include 'views/layouts/header.php'; ?>
<h2>Quản lý Danh Mục</h2>
<a href="index.php?controller=danhmuc&action=create" class="btn btn-primary mb-3">+ Thêm danh mục</a>
<table class="table table-bordered">
    <tr><th>ID</th><th>Tên danh mục</th><th>Mô tả</th><th>Thao tác</th></tr>
    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['ten_danh_muc']) ?></td>
        <td><?= htmlspecialchars($row['mo_ta']) ?></td>
        <td>
            <a href="index.php?controller=danhmuc&action=edit&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
            <a href="index.php?controller=danhmuc&action=delete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa danh mục này?')">Xóa</a>
        </td>
    </tr>
    <?php } ?>
</table>
<?php include 'views/layouts/footer.php'; ?>