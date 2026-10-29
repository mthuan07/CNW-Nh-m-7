<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-boxes text-primary"></i> Quản Lý Kho Hàng</h2>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Mã SP</th><th>Tên sản phẩm</th><th>Danh mục</th><th>Đơn vị</th><th>Giá bán</th><th>Tồn kho</th><th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)): foreach ($products as $row): ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($row['product_code']) ?></td>
                        <td><?= htmlspecialchars($row['product_name']) ?></td>
                        <td><span class="badge bg-secondary"><?= htmlspecialchars($row['category']) ?></span></td>
                        <td><?= htmlspecialchars($row['unit']) ?></td>
                        <td class="text-success fw-bold"><?= number_format($row['price']) ?> đ</td>
                        <td><span class="badge <?= $row['quantity'] > 10 ? 'bg-success' : 'bg-danger' ?>"><?= $row['quantity'] ?></span></td>
                        <td class="text-center">

                         <!-- Nút Sửa -->
                            <a href="index.php?controller=inventory&action=edit&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning text-white me-1">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
    
                        <!-- Nút Xóa (Có hộp thoại xác nhận trước khi xóa) -->
                            <a href="index.php?controller=inventory&action=delete&id=<?= $row['id'] ?>" 
                                class="btn btn-sm btn-danger" 
                                 onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi kho không?');">
                                <i class="fas fa-trash"></i> Xóa
                             </a>
                             <a href="index.php?controller=inventory&action=detail&id=<?= $row['id'] ?>" class="btn btn-sm btn-info text-white me-1" title="Xem chi tiết">
                                <i class="fas fa-eye"></i> Chi tiết
                            </a>
                            </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="7" class="text-center text-muted py-4">Chưa có dữ liệu sản phẩm trong kho.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>