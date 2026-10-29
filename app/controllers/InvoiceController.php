<?php
    require_once APP_ROOT.'/app/services/InvoiceService.php';

    class InvoiceController{
        public function index(){
            $invoiceService = new InvoiceService();
            $invoices = $invoiceService->getAllInvoices();
            if($invoices === null){
                echo 'Không thể kết nối cơ sở dữ liệu.';
                return;
            }
            include APP_ROOT.'/app/views/invoice/index.php';
        }

        public function add(){
            $invoice = null;
            $invoiceItems = [];
            $invoiceService = new InvoiceService();
            $inventory = $invoiceService->getAllInventory();
            if($inventory === null){
                echo 'Không thể kết nối cơ sở dữ liệu.';
                return;
            }
            $phone = '';
            $pointsUsed = 0;
            include APP_ROOT.'/app/views/invoice/popup_form.php';
        }

        public function store(){
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
            $pointsUsed = isset($_POST['points_used']) ? $_POST['points_used'] : 0;
            $inventoryIds = isset($_POST['inventory_id']) && is_array($_POST['inventory_id']) ? $_POST['inventory_id'] : [];
            $quantities = isset($_POST['quantity']) && is_array($_POST['quantity']) ? $_POST['quantity'] : [];
            $invoiceService = new InvoiceService();
            $error = $invoiceService->addInvoice($phone,$pointsUsed,$inventoryIds,$quantities);

            if($error != ''){
                echo $error;
                return;
            }else{
                header('Location: ?controller=invoice');
                return;
            }
        }

        public function edit($id){
            if(isset($id)){
                $invoiceService = new InvoiceService();
                $invoice = $invoiceService->getInvoiceById($id);
                if($invoice == null){
                    echo 'Không tìm thấy hóa đơn.';
                    return;
                }
                $invoiceItems = $invoiceService->getInvoiceItemsByInvoiceId($id);
                $inventory = $invoiceService->getAllInventory();
                if($inventory === null){
                    echo 'Không thể kết nối cơ sở dữ liệu.';
                    return;
                }
                $customer = $invoice->getCustomerId() != null ? $invoiceService->getCustomerById($invoice->getCustomerId()) : null;
                $phone = $customer != null ? $customer->getPhone() : '';
                $pointsUsed = $invoice->getPointsUsed();
                include APP_ROOT.'/app/views/invoice/popup_form.php';
            }else{
                echo 'Id is null';
            }
        }

        public function update($id){
            if(isset($id)){
                $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
                $pointsUsed = isset($_POST['points_used']) ? $_POST['points_used'] : 0;
                $inventoryIds = isset($_POST['inventory_id']) && is_array($_POST['inventory_id']) ? $_POST['inventory_id'] : [];
                $quantities = isset($_POST['quantity']) && is_array($_POST['quantity']) ? $_POST['quantity'] : [];
                $invoiceService = new InvoiceService();
                $error = $invoiceService->updateInvoice($id,$phone,$pointsUsed,$inventoryIds,$quantities);

                if($error != ''){
                    echo $error;
                    return;
                }else{
                    header('Location: ?controller=invoice');
                    return;
                }
            }else{
                echo 'Id is null';
            }
        }

        public function delete($id){
            if(isset($id)){
                $invoiceService = new InvoiceService();
                $error = $invoiceService->deleteInvoice($id);
                if($error != ''){
                    echo $error;
                    return;
                }else{
                    header('Location: ?controller=invoice');
                }
            }else{
                echo 'Id is null';
            }
        }

        public function detail($id){
            if(isset($id)){
                $invoiceService = new InvoiceService();
                $invoice = $invoiceService->getInvoiceById($id);
                if($invoice == null){
                    echo 'Không tìm thấy hóa đơn.';
                    return;
                }
                $invoiceItems = $invoiceService->getInvoiceItemsByInvoiceId($id);
                $customer = $invoice->getCustomerId() != null ? $invoiceService->getCustomerById($invoice->getCustomerId()) : null;
                if($customer == null && $invoice->getCustomerId() != null){
                    echo 'Không tìm thấy khách hàng của hóa đơn.';
                    return;
                }
                include APP_ROOT.'/app/views/invoice/detail.php';
            }else{
                echo 'Id is null';
            }
        }
    }
?>
