<?php
// app/models/Product.php
    class Product{
        private $id;
        private $name;
        private $price;
        private $quantity;
        private $description;
        private $categoryId;

        public function __construct($id,$name,$price,$quantity,$description,$categoryId)
        {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
            $this->quantity = $quantity;
            $this->description = $description;
            $this->categoryId = $categoryId;
        }

        public function getId(){
            return $this->id;
        }

        public function getName(){
            return $this->name;
        }

        public function getPrice(){
            return $this->price;
        }

        public function getQuantity(){
            return $this->quantity;
        }

        public function getDescription(){
            return $this->description;
        }

        public function getCategoryId(){
            return $this->categoryId;
        }
    };
?>