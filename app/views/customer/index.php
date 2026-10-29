<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-users text-danger"></i> Quản Lý Khách Hàng (Khang)</h2>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr><th>Mã KH</th><th>Họ tên</th><th>Số điện thoại</th><th>Điểm tích lũy</th><th class="text-center">Thao tác</th></tr>
                </thead>
                <tbody>
                    <?php if (!empty($customers)): foreach ($customers as $c): ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($c['customer_code']) ?></td>
                        <td><?= htmlspecialchars($c['full_name']) ?></td>
                        <td><?= htmlspecialchars($c['phone']) ?></td>
                        <td><span class="badge bg-primary"><?= $c['points'] ?> điểm</span></td>
                        <td class="text-center"><span class="text-muted">Đang cập nhật</span></td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="5" class="text-center text-muted py-4">Chưa có khách hàng nào.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>