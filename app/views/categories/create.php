<?php include 'views/layouts/header.php'; ?>
<h2>Thêm Danh Mục</h2>
<form method="POST">
    <div class="mb-3"><label>Tên danh mục</label><input type="text" name="name" class="form-control" required></div>
    <div class="mb-3"><label>Mô tả</label><textarea name="description" class="form-control"></textarea></div>
    <button type="submit" class="btn btn-success">Lưu</button>
    <a href="index.php?controller=category&action=index" class="btn btn-secondary">Quay lại</a>
</form>
<?php include 'views/layouts/footer.php'; ?>