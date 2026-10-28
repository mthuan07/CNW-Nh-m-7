<?php
class ProductController{
    public function add()
    {
        $productService = new ProductService();
        $categories = $productService->getAllCategories();
        include APP_ROOT.'/app/views/product/create.php';
    }

    public function store()
    {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];
        $categoryId = $_POST['category_id'];
        $product = new Product(null,$name,$price,$quantity,$description,$categoryId);

        $productService = new ProductService();
        $productService->addProduct($product);

        header('Location: ?controller=home');
    }
}
?>