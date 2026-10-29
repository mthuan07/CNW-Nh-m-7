<?php include APP_ROOT.'/app/views/layouts/header.php'; ?>
        <h3 class="text-center text-uppercase text-success mt-3 mb-3">Danh sách hóa đơn</h3>
        <a href="?controller=addInvoice" class="btn btn-success">Thêm hóa đơn</a>
        <a href="?controller=home" class="btn btn-secondary">Trang chủ</a>
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>Mã hóa đơn</th>
                    <th>Ngày</th>
                    <th>Sản phẩm</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Giảm giá</th>
                    <th>Thành tiền</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($invoices as $invoice){ ?>
                    <tr>
                        <td><?= htmlspecialchars($invoice->getInvoiceCode(),ENT_QUOTES,'UTF-8'); ?></td>
                        <td><?= htmlspecialchars($invoice->getInvoiceDate(),ENT_QUOTES,'UTF-8'); ?></td>
                        <td><?= htmlspecialchars($invoiceService->getInvoiceProductNames($invoice->getId()),ENT_QUOTES,'UTF-8'); ?></td>
                        <td>
                            <?php
                                $customer = $invoice->getCustomerId() != null ? $invoiceService->getCustomerById($invoice->getCustomerId()) : null;
                                echo $customer != null ? htmlspecialchars($customer->getFullName(),ENT_QUOTES,'UTF-8') : '';
                            ?>
                        </td>
                        <td><?= number_format((float)$invoice->getTotalAmount(),0,',','.'); ?> đ</td>
                        <td><?= number_format((float)$invoice->getDiscount(),0,',','.'); ?> đ</td>
                        <td><?= number_format((float)$invoice->getFinalAmount(),0,',','.'); ?> đ</td>
                        <td class="text-nowrap">
                            <a class="btn btn-sm btn-info" href="?controller=detailInvoice&id=<?= (int)$invoice->getId(); ?>">Chi tiết</a>
                            <a class="btn btn-sm btn-warning" href="?controller=editInvoice&id=<?= (int)$invoice->getId(); ?>">Sửa</a>
                            <a class="btn btn-sm btn-danger" href="?controller=deleteInvoice&id=<?= (int)$invoice->getId(); ?>">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
                <?php if(count($invoices) == 0){ ?>
                    <tr><td colspan="8" class="text-center">Chưa có hóa đơn.</td></tr>
                <?php } ?>
            </tbody>
        </table>
<?php include APP_ROOT.'/app/views/layouts/footer.php'; ?>
