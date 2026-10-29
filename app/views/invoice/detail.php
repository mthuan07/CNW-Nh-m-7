<?php include APP_ROOT.'/app/views/layouts/header.php'; ?>
        <h3 class="text-center text-uppercase text-success mt-3 mb-3">Chi tiết hóa đơn</h3>
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Mã hóa đơn:</strong> <?= htmlspecialchars($invoice->getInvoiceCode(),ENT_QUOTES,'UTF-8'); ?></p>
                <p><strong>Ngày lập:</strong> <?= htmlspecialchars($invoice->getInvoiceDate(),ENT_QUOTES,'UTF-8'); ?></p>
                <p><strong>Khách hàng:</strong> <?= $customer != null ? htmlspecialchars($customer->getFullName(),ENT_QUOTES,'UTF-8') : ''; ?></p>
                <p><strong>Tổng tiền:</strong> <?= number_format((float)$invoice->getTotalAmount(),0,',','.'); ?> đ</p>
                <p><strong>Điểm sử dụng:</strong> <?= (int)$invoice->getPointsUsed(); ?></p>
                <p><strong>Giảm giá:</strong> <?= number_format((float)$invoice->getDiscount(),0,',','.'); ?> đ</p>
                <p><strong>Thành tiền:</strong> <?= number_format((float)$invoice->getFinalAmount(),0,',','.'); ?> đ</p>
                <p class="mb-0"><strong>Điểm tích lũy:</strong> <?= (int)$invoice->getPointsEarned(); ?></p>
            </div>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($invoiceItems as $invoiceItem){ ?>
                    <tr>
                        <td><?= htmlspecialchars($invoiceService->getInventoryById($invoiceItem->getInventoryId())->getProductName(),ENT_QUOTES,'UTF-8'); ?></td>
                        <td><?= htmlspecialchars((string)$invoiceItem->getQuantity(),ENT_QUOTES,'UTF-8'); ?></td>
                        <td><?= number_format((float)$invoiceItem->getUnitPrice(),0,',','.'); ?> đ</td>
                        <td><?= number_format((float)$invoiceItem->getLineTotal(),0,',','.'); ?> đ</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="?controller=invoice" class="btn btn-secondary">Quay lại danh sách</a>
<?php include APP_ROOT.'/app/views/layouts/footer.php'; ?>
