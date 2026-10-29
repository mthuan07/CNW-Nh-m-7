<h2><i class="fas fa-truck-loading text-warning"></i> Quản Lý Nhập Hàng (Thuận)</h2>
<div class="card shadow-sm mt-3"><div class="card-body"><table class="table table-hover"><thead class="table-dark"><tr><th>Mã phiếu</th><th>Nhà cung cấp</th><th>Ngày nhập</th><th>Tổng tiền</th></tr></thead><tbody>
<?php if(!empty($receipts)) foreach($receipts as $r): ?>
<tr><td><?= $r['receipt_code'] ?></td><td><?= $r['supplier'] ?></td><td><?= $r['receipt_date'] ?></td><td class="fw-bold text-primary"><?= number_format($r['total_amount']) ?>đ</td></tr>
<?php endforeach; 
else: ?><tr><td colspan="4" class="text-center text-muted">Chưa có phiếu nhập nào.</td></tr><?php endif; ?>
</tbody></table></div></div>