<?php include 'views/layouts/header.php'; ?>
<h2>Sửa Danh Mục</h2>
<form method="POST">
    <div class="mb-3"><label>Tên danh mục</label><input type="text" name="ten_danh_muc" class="form-control" value="<?= htmlspecialchars($row['ten_danh_muc']) ?>" required></div>
    <div class="mb-3"><label>Mô tả</label><textarea name="mo_ta" class="form-control"><?= htmlspecialchars($row['mo_ta']) ?></textarea></div>
    <button type="submit" class="btn btn-success">Cập nhật</button>
    <a href="index.php?controller=danhmuc&action=index" class="btn btn-secondary">Quay lại</a>
</form>
<?php include 'views/layouts/footer.php'; ?>