<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white fw-bold">
                <i class="fas fa-info-circle"></i> Chi Tiết Sản Phẩm (Kho Hàng)
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th class="w-25 bg-light">ID</th>
                        <td><?= $product['id'] ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Mã sản phẩm</th>
                        <td class="fw-bold text-primary"><?= htmlspecialchars($product['product_code']) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Tên sản phẩm</th>
                        <td><?= htmlspecialchars($product['product_name']) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Danh mục</th>
                        <td><span class="badge bg-secondary"><?= htmlspecialchars($product['category']) ?></span></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Đơn vị tính</th>
                        <td><?= htmlspecialchars($product['unit']) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Giá bán</th>
                        <td class="text-success fw-bold"><?= number_format($product['price']) ?> đ</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Số lượng tồn kho</th>
                        <td>
                            <span class="badge <?= $product['quantity'] > 10 ? 'bg-success' : 'bg-danger' ?>">
                                <?= $product['quantity'] ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Ngày tạo hệ thống</th>
                        <td><?= $product['created_at'] ?></td>
                    </tr>
                </table>

                <div class="d-flex justify-content-between mt-4">
                    <a href="index.php?controller=inventory&action=index" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại danh sách
                    </a>
                    <a href="index.php?controller=inventory&action=edit&id=<?= $product['id'] ?>" class="btn btn-warning text-white">
                        <i class="fas fa-edit"></i> Chỉnh sửa sản phẩm này
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>