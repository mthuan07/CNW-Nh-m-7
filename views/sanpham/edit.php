<?php include 'views/layouts/header.php'; ?>
<h2>Sửa Sản Phẩm</h2>
<form method="POST">
    <div class="mb-3"><label>Tên sản phẩm</label><input type="text" name="ten_san_pham" class="form-control" value="<?= htmlspecialchars($row['ten_san_pham']) ?>" required></div>
    <div class="mb-3"><label>Giá</label><input type="number" step="0.01" name="gia" class="form-control" value="<?= $row['gia'] ?>" required></div>
    <div class="mb-3"><label>Số lượng</label><input type="number" name="so_luong" class="form-control" value="<?= $row['so_luong'] ?>" required></div>
    <div class="mb-3"><label>Danh mục</label>
        <select name="danh_muc_id" class="form-control" required>
            <?php while ($dm = $danhmucs->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?= $dm['id'] ?>" <?= ($dm['id'] == $row['danh_muc_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($dm['ten_danh_muc']) ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3"><label>Mô tả</label><textarea name="mo_ta" class="form-control"><?= htmlspecialchars($row['mo_ta']) ?></textarea></div>
    <button type="submit" class="btn btn-success">Cập nhật</button>
    <a href="index.php?controller=sanpham&action=index" class="btn btn-secondary">Quay lại</a>
</form>
<?php include 'views/layouts/footer.php'; ?>