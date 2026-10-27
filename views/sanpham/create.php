<?php include 'views/layouts/header.php'; ?>
<h2>Thêm Sản Phẩm</h2>
<form method="POST">
    <div class="mb-3"><label>Tên sản phẩm</label><input type="text" name="ten_san_pham" class="form-control" required></div>
    <div class="mb-3"><label>Giá</label><input type="number" step="0.01" name="gia" class="form-control" required></div>
    <div class="mb-3"><label>Số lượng</label><input type="number" name="so_luong" class="form-control" required></div>
    <div class="mb-3"><label>Danh mục</label>
        <select name="danh_muc_id" class="form-control" required>
            <option value="">-- Chọn danh mục --</option>
            <?php while ($dm = $danhmucs->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?= $dm['id'] ?>"><?= htmlspecialchars($dm['ten_danh_muc']) ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3"><label>Mô tả</label><textarea name="mo_ta" class="form-control"></textarea></div>
    <button type="submit" class="btn btn-success">Lưu</button>
    <a href="index.php?controller=sanpham&action=index" class="btn btn-secondary">Quay lại</a>
</form>
<?php include 'views/layouts/footer.php'; ?>