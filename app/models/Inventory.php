<?php
    class Inventory{
        private $id;
        private $productCode;
        private $productName;
        private $category;
        private $unit;
        private $price;
        private $quantity;
        private $createdAt;

        public function __construct($id,$productCode,$productName,$category,$unit,$price,$quantity,$createdAt)
        {
            $this->id = $id;
            $this->productCode = $productCode;
            $this->productName = $productName;
            $this->category = $category;
            $this->unit = $unit;
            $this->price = $price;
            $this->quantity = $quantity;
            $this->createdAt = $createdAt;
        }

        public function getId(){ return $this->id; }
        public function getProductCode(){ return $this->productCode; }
        public function getProductName(){ return $this->productName; }
        public function getCategory(){ return $this->category; }
        public function getUnit(){ return $this->unit; }
        public function getPrice(){ return $this->price; }
        public function getQuantity(){ return $this->quantity; }
        public function getCreatedAt(){ return $this->createdAt; }
    };
?>
