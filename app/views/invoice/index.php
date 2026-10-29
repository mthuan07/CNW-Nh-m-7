<h2><i class="fas fa-file-invoice-dollar text-success"></i> Quản Lý Hóa Đơn (Hiếu)</h2>
<div class="card shadow-sm mt-3"><div class="card-body"><table class="table table-hover"><thead class="table-dark"><tr><th>Mã HĐ</th><th>Ngày lập</th><th>Tổng tiền</th><th>Giảm giá</th><th>Thực trả</th></tr></thead><tbody>
<?php if(!empty($invoices)) foreach($invoices as $i): ?>
<tr><td><?= $i['invoice_code'] ?></td><td><?= $i['invoice_date'] ?></td><td><?= number_format($i['total_amount']) ?>đ</td><td><?= number_format($i['discount']) ?>đ</td><td class="fw-bold text-success"><?= number_format($i['final_amount']) ?>đ</td></tr>
<?php endforeach; else: ?><tr><td colspan="5" class="text-center text-muted">Chưa có hóa đơn nào.</td></tr><?php endif; ?>
</tbody></table></div></div>