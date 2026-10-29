<?php include APP_ROOT.'/app/views/layouts/header.php'; ?>
    <div class="container mt-5">
        <h3 class="text-center text-uppercase text-success mt-3 mb-3">Danh sách hóa đơn</h3>
        <a href="?controller=addInvoice" class="btn btn-success">Thêm hóa đơn</a>
        <?php $invoiceService = new InvoiceService(); ?>
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>Mã hóa đơn</th>
                    <th>Ngày lập</th>
                    <th>Sản phẩm</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Giảm giá</th>
                    <th>Thực trả</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($invoices as $invoice){ ?>
                    <tr>
                        <td><?= $invoice->getInvoiceCode(); ?></td>
                        <td><?= $invoice->getInvoiceDate(); ?></td>
                        <td><?= $invoiceService->getInvoiceProductNames($invoice->getId()); ?></td>
                        <td>
                            <?php if($invoice->getCustomerId() != null){ ?>
                                <?php $customer = $invoiceService->getCustomerById($invoice->getCustomerId()); ?>
                                <?= $customer->getFullName(); ?>
                            <?php } ?>
                        </td>
                        <td><?= $invoice->getTotalAmount(); ?></td>
                        <td><?= $invoice->getDiscount(); ?></td>
                        <td><?= $invoice->getFinalAmount(); ?></td>
                        <td>
                            <a href="?controller=detailInvoice&id=<?= $invoice->getId(); ?>">Chi tiết</a>
                            <a href="?controller=editInvoice&id=<?= $invoice->getId(); ?>">Sửa</a>
                            <a href="?controller=deleteInvoice&id=<?= $invoice->getId(); ?>">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php include APP_ROOT.'/app/views/layouts/footer.php'; ?>
