<?php
    class Customer{
        private $id;
        private $customerCode;
        private $fullName;
        private $phone;
        private $points;

        public function __construct($id,$customerCode,$fullName,$phone,$points)
        {
            $this->id = $id;
            $this->customerCode = $customerCode;
            $this->fullName = $fullName;
            $this->phone = $phone;
            $this->points = $points;
        }

        public function getId(){ return $this->id; }
        public function getCustomerCode(){ return $this->customerCode; }
        public function getFullName(){ return $this->fullName; }
        public function getPhone(){ return $this->phone; }
        public function getPoints(){ return $this->points; }
    };
?>
