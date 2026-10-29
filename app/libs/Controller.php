<?php
class Controller {
    public function view($viewPath, $data = []) {
        extract($data);
        $viewFile = __DIR__ . '/../views/' . $viewPath . '.php';
        if (file_exists($viewFile)) {
            require_once __DIR__ . '/../views/layouts/header.php';
            require_once $viewFile;
            require_once __DIR__ . '/../views/layouts/footer.php';
        } else {
            die("Không tìm thấy giao diện: $viewPath");
        }
    }
}