<?php 
    require_once APP_ROOT.'/app/models/Product.php';
    class ProductService{
        public function getAllCategories(){
            $categories = [];
            $dbConnection = new DbConnection();

            if($dbConnection != null){
                $conn = $dbConnection->getConnection();

                if($conn != null){
                    $sql = "SELECT * FROM danh_muc";
                    $stmt = $conn->query($sql);

                    while($row = $stmt->fetch()){
                        $categories[] = $row;
                    }

                    return $categories;
                }
            }
        }

        public function addProduct(Product $product){
            $dbConnection = new DbConnection();

            if($dbConnection != null){
                $conn = $dbConnection->getConnection();

                if($conn != null){
                    $name = $product->getName();
                    $price = $product->getPrice();
                    $quantity = $product->getQuantity();
                    $description = $product->getDescription();
                    $categoryId = $product->getCategoryId();
                    $sql = "INSERT INTO san_pham (ten_san_pham,gia,so_luong,mo_ta,danh_muc_id) VALUES ('$name','$price','$quantity','$description','$categoryId')";
                    $conn->exec($sql);
                }
            }
        }
    };
?>