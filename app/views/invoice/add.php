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
    <title>Thêm hóa đơn</title>
</head>
<body>
    <div class="container mt-5">

    <h3 class="text-center
                text-uppercase
                text-success
                mt-3 mb-3">
        Thêm hóa đơn
    </h3>

    <form  action="?controller=addInvoice" method="post">

        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại khách hàng</label>
            <input type="text" class="form-control" id="phone" name="phone">
        </div>

        <div class="mb-3">
            <label for="points_used" class="form-label">Điểm sử dụng</label>
            <input type="number" class="form-control" id="points_used" name="points_used" value="0">
        </div>

        <?php for($i = 0; $i < 5; $i++){ ?>
        <div class="mb-3">
            <label class="form-label">Sản phẩm <?= $i + 1; ?></label>
            <select name="inventory_id[]" class="form-select">
                <option value="">-- Chọn sản phẩm --</option>
                <?php foreach($inventory as $product){ ?>
                <option value="<?= $product->getId(); ?>"><?= $product->getProductName(); ?> (tồn: <?= $product->getQuantity(); ?>)</option>
                <?php } ?>
            </select>
            <input type="number" class="form-control mt-1" name="quantity[]" min="0" placeholder="Số lượng">
        </div>
        <?php } ?>

        <button type="submit" class="btn btn-primary" name="btn_create">Thêm</button>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script>
        document.querySelector('form').addEventListener('submit',function (e){
            if(document.querySelector('select[name="inventory_id[]"]').value === ''){
                e.preventDefault();
                alert('Vui lòng chọn sản phẩm');
            }
        });
    </script>

</body>
</html>
