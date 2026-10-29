<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark fw-bold"><i class="fas fa-edit"></i> Sửa Sản Phẩm</div>
            <div class="card-body">
                <form action="index.php?controller=inventory&action=edit&id=<?= $product['id'] ?>" method="POST">
                    <div class="mb-3"><label class="form-label fw-bold">Mã sản phẩm</label><input type="text" class="form-control" value="<?= htmlspecialchars($product['product_code']) ?>" disabled></div>
                    <div class="mb-3"><label class="form-label fw-bold">Tên sản phẩm</label><input type="text" name="product_name" class="form-control" value="<?= htmlspecialchars($product['product_name']) ?>" required></div>
                    <div class="mb-3"><label class="form-label fw-bold">Danh mục</label><input type="text" name="category" class="form-control" value="<?= htmlspecialchars($product['category']) ?>" required></div>
                    <div class="mb-3"><label class="form-label fw-bold">Đơn vị tính</label><input type="text" name="unit" class="form-control" value="<?= htmlspecialchars($product['unit']) ?>" required></div>
                    <div class="mb-3"><label class="form-label fw-bold">Giá bán (VNĐ)</label><input type="number" name="price" class="form-control" value="<?= $product['price'] ?>" min="0" required></div>
                    <div class="mb-3"><label class="form-label fw-bold">Số lượng tồn kho (Khóa)</label><input type="number" class="form-control bg-light" value="<?= $product['quantity'] ?>" disabled></div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php?controller=inventory&action=index" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>