<?php
    require_once __DIR__.'/../app/config/config.php';
    require_once APP_ROOT.'/app/libs/Database.php';
    require_once APP_ROOT.'/app/controllers/HomeController.php';
    require_once APP_ROOT.'/app/controllers/InvoiceController.php';

    $controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    $homeController = new HomeController();
    $invoiceController = new InvoiceController();

    if($controller == 'home'){
        $homeController->index();
    }else if($controller == 'invoice'){
        $invoiceController->index();
    }else if(isset($_POST['btn_create'])){
        $invoiceController->store();
    }else if($controller == 'addInvoice'){
        $invoiceController->add();
    }else if(isset($_POST['btn_update'])){
        $invoiceController->update($id);
    }else if($controller == 'editInvoice'){
        $invoiceController->edit($id);
    }else if($controller == 'deleteInvoice'){
        $invoiceController->delete($id);
    }else if($controller == 'detailInvoice'){
        $invoiceController->detail($id);
    }else{
        echo 'Không tìm thấy hành động phù hợp.';
    }
?>
