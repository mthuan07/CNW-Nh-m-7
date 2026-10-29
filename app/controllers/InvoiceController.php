<?php
class InvoiceController{
    public function index()
    {
        require_once APP_ROOT.'/app/services/InvoiceService.php';
        $invoiceService = new InvoiceService();
        $invoices = $invoiceService->getAllInvoices();
        include APP_ROOT.'/app/views/invoice/index.php';
    }

    public function add()
    {
        require_once APP_ROOT.'/app/services/InvoiceService.php';
        $invoice = null;
        $invoiceItems = [];
        $invoiceService = new InvoiceService();
        $inventory = $invoiceService->getAllInventory();
        $phone = '';
        $pointsUsed = 0;
        include_once APP_ROOT . '/app/views/invoice/add.php';
    }

    public function store()
    {
        require_once APP_ROOT.'/app/services/InvoiceService.php';
        $phone = $_POST['phone'];
        $pointsUsed = $_POST['points_used'];
        $inventoryIds = $_POST['inventory_id'];
        $quantities = $_POST['quantity'];
        $invoice = new Invoice(null,null,null,null,$pointsUsed,null,null,null,null,$phone,$inventoryIds,$quantities);

        $invoiceService = new InvoiceService();
        $invoiceService->addInvoice($invoice);

        header('Location: ?controller=invoice');
    }

    public function edit($id){
        if(isset($id)){
            require_once APP_ROOT.'/app/services/InvoiceService.php';
            $invoiceService = new InvoiceService();
            $invoice = $invoiceService->getInvoiceById($id);
            $invoiceItems = $invoiceService->getInvoiceItemsByInvoiceId($id);
            $inventory = $invoiceService->getAllInventory();
            $phone = $invoice->getPhone();
            $pointsUsed = $invoice->getPointsUsed();

            include APP_ROOT.'/app/views/invoice/edit.php';
        }else{
            echo 'Id is null';
        }
    }

    public function update($id){
        require_once APP_ROOT.'/app/services/InvoiceService.php';
        $phone = $_POST['phone'];
        $pointsUsed = $_POST['points_used'];
        $inventoryIds = $_POST['inventory_id'];
        $quantities = $_POST['quantity'];
        $invoice_new = new Invoice($id,null,null,null,$pointsUsed,null,null,null,null,$phone,$inventoryIds,$quantities);
        $invoiceService = new InvoiceService();
        $invoiceService->updateInvoice($invoice_new);
        header('Location: ?controller=invoice');
    }

    public function delete($id){
        if(isset($id)){
            require_once APP_ROOT.'/app/services/InvoiceService.php';
            $invoiceService = new InvoiceService();
            $invoiceService->deleteInvoice($id);
            header('Location: ?controller=invoice');
        }else{
            echo 'Id is null';
        }
    }

    public function detail($id){
        if(isset($id)){
            require_once APP_ROOT.'/app/services/InvoiceService.php';
            $invoiceService = new InvoiceService();
            $invoice = $invoiceService->getInvoiceById($id);
            $invoiceItems = $invoiceService->getInvoiceItemsByInvoiceId($id);
            $customer = $invoiceService->getCustomerById($invoice->getCustomerId());

            include APP_ROOT.'/app/views/invoice/detail.php';
        }else{
            echo 'Id is null';
        }
    }
}
