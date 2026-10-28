<?php
    require_once('../app/config/config.php');
    require_once APP_ROOT.'/app/libs/DbConnection.php';
    require_once APP_ROOT.'/app/services/ProductService.php';
    require_once APP_ROOT.'/app/controllers/HomeController.php';
    require_once APP_ROOT.'/app/controllers/ProductController.php';

    $controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';

    $homeController = new HomeController();
    $productController = new ProductController();

    if($controller == 'home'){
        $homeController->index();
    }else if(isset($_POST['btn_create'])){
        $productController->store();
    }else if($controller == 'addProduct'){
        $productController->add();
    }
?>