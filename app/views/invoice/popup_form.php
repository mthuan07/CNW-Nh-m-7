<?php include APP_ROOT.'/app/views/layouts/header.php'; ?>
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
    <div class="container mt-5">
        <h3 class="text-center text-uppercase text-success mt-3 mb-3">
            <?= $invoice == null ? 'Thêm hóa đơn' : 'Cập nhật hóa đơn'; ?>
        </h3>
        <form action="<?= $invoice == null ? '?controller=addInvoice' : '?controller=editInvoice&id='.$invoice->getId(); ?>" method="post">
            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại khách hàng (để trống nếu khách lẻ)</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= isset($phone) ? htmlspecialchars((string)$phone,ENT_QUOTES,'UTF-8') : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="points_used" class="form-label">Điểm sử dụng</label>
                <input type="number" min="0" step="1" class="form-control" id="points_used" name="points_used" value="<?= isset($pointsUsed) ? htmlspecialchars((string)$pointsUsed,ENT_QUOTES,'UTF-8') : 0; ?>">
            </div>
            <?php for($i = 0; $i < 5; $i++){ ?>
                <div class="mb-3">
                    <label class="form-label">Sản phẩm <?= $i + 1; ?></label>
                    <select name="inventory_id[]" class="form-select">
                        <option value="">-- Chọn sản phẩm --</option>
                        <?php foreach($inventory as $product){ ?>
                            <option value="<?= $product->getId(); ?>" <?= isset($invoiceItems[$i]) && $invoiceItems[$i]->getInventoryId() == $product->getId() ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($product->getProductName(),ENT_QUOTES,'UTF-8'); ?> - <?= number_format((float)$product->getPrice(),0,',','.'); ?> đ (Tồn: <?= htmlspecialchars((string)$product->getQuantity(),ENT_QUOTES,'UTF-8'); ?>)
                            </option>
                        <?php } ?>
                    </select>
                    <label class="form-label mt-2">Số lượng</label>
                    <input type="number" min="0.001" step="any" name="quantity[]" class="form-control" value="<?= isset($invoiceItems[$i]) ? htmlspecialchars((string)$invoiceItems[$i]->getQuantity(),ENT_QUOTES,'UTF-8') : ''; ?>">
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary" name="<?= $invoice == null ? 'btn_create' : 'btn_update'; ?>">
                <?= $invoice == null ? 'Thêm' : 'Cập nhật'; ?>
            </button>
            <a href="?controller=invoice" class="btn btn-secondary mt-2">Quay lại</a>
        </form>
    </div>
    <script>
        document.querySelector('form').addEventListener('submit',function (e){
            var inventorySelects = document.querySelectorAll('select[name="inventory_id[]"]');
            var hasInventory = false;
            for(var i = 0; i < inventorySelects.length; i++){
                if(inventorySelects[i].value !== ''){
                    hasInventory = true;
                }
            }
            if(!hasInventory){
                e.preventDefault();
                alert('Vui lòng chọn sản phẩm');
            }
        });
    </script>
<?php include APP_ROOT.'/app/views/layouts/footer.php'; ?>
