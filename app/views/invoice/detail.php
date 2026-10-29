<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        form{
            width: 30%;
            margin: auto;
        }
        button{
            margin-top: 10px;
            width: 100%;
        }
    </style>
    <title>Chi tiết hóa đơn</title>
</head>
<body>
    <div class="container mt-5">

    <h3 class="text-center
                text-uppercase
                text-success
                mt-3 mb-3">
        Chi tiết hóa đơn
    </h3>

    <table class="table table-bordered">
        <tr>
            <th>Mã hóa đơn</th>
            <td><?= $invoice->getInvoiceCode(); ?></td>
        </tr>
        <tr>
            <th>Ngày</th>
            <td><?= $invoice->getInvoiceDate(); ?></td>
        </tr>
        <tr>
            <th>Khách hàng</th>
            <td>
                <?php if($customer != null){ ?>
                    <?= $customer->getFullName(); ?> - <?= $customer->getPhone(); ?>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <th>Tổng tiền</th>
            <td><?= $invoice->getTotalAmount(); ?></td>
        </tr>
        <tr>
            <th>Điểm sử dụng</th>
            <td><?= $invoice->getPointsUsed(); ?></td>
        </tr>
        <tr>
            <th>Giảm giá</th>
            <td><?= $invoice->getDiscount(); ?></td>
        </tr>
        <tr>
            <th>Thực trả</th>
            <td><?= $invoice->getFinalAmount(); ?></td>
        </tr>
        <tr>
            <th>Điểm tích lũy</th>
            <td><?= $invoice->getPointsEarned(); ?></td>
        </tr>
    </table>

    <table class="table table-bordered table-striped">
        <tr>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
        <?php foreach($invoiceItems as $invoiceItem){ ?>
        <?php $product = $invoiceService->getInventoryById($invoiceItem->getInventoryId()); ?>
        <tr>
            <td><?= $product->getProductName(); ?></td>
            <td><?= $invoiceItem->getQuantity(); ?></td>
            <td><?= $invoiceItem->getUnitPrice(); ?></td>
            <td><?= $invoiceItem->getLineTotal(); ?></td>
        </tr>
        <?php } ?>
    </table>

    <a href="?controller=invoice" class="btn btn-primary">Quay lại</a>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html>
