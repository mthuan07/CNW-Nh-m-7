<?php
class Router {
    public function dispatch() {
        $controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) . 'Controller' : 'HomeController';
        $actionName = isset($_GET['action']) ? $_GET['action'] : 'index';
        
        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $actionName)) {
                    $controller->$actionName();
                    return;
                }
            }
        }
        http_response_code(404);
        echo "<h3 class='text-center text-danger mt-5'>404 - Không tìm thấy trang yêu cầu!</h3>";
    }
}