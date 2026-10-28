<?php include 'views/layouts/header.php'; ?>
<h2>Sửa Sản Phẩm</h2>
<form method="POST">
    <div class="mb-3"><label>Tên sản phẩm</label><input type="text" name="name" class="form-control" value="<?= htmlspecialchars($row['ten_san_pham']) ?>" required></div>
    <div class="mb-3"><label>Giá</label><input type="number" step="0.01" name="price" class="form-control" value="<?= $row['gia'] ?>" required></div>
    <div class="mb-3"><label>Số lượng</label><input type="number" name="quantity" class="form-control" value="<?= $row['so_luong'] ?>" required></div>
    <div class="mb-3"><label>Danh mục</label>
        <select name="category_id" class="form-control" required>
            <?php while ($category = $categories->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?= $category['id'] ?>" <?= ($category['id'] == $row['danh_muc_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['ten_danh_muc']) ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3"><label>Mô tả</label><textarea name="description" class="form-control"><?= htmlspecialchars($row['mo_ta']) ?></textarea></div>
    <button type="submit" class="btn btn-success">Cập nhật</button>
    <a href="index.php?controller=product&action=index" class="btn btn-secondary">Quay lại</a>
</form>
<?php include 'views/layouts/footer.php'; ?>