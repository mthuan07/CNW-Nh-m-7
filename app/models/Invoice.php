<?php
    class Invoice{
        private $id;
        private $invoiceCode;
        private $customerId;
        private $totalAmount;
        private $pointsUsed;
        private $discount;
        private $finalAmount;
        private $pointsEarned;
        private $invoiceDate;

        public function __construct($id,$invoiceCode,$customerId,$totalAmount,$pointsUsed,$discount,$finalAmount,$pointsEarned,$invoiceDate)
        {
            $this->id = $id;
            $this->invoiceCode = $invoiceCode;
            $this->customerId = $customerId;
            $this->totalAmount = $totalAmount;
            $this->pointsUsed = $pointsUsed;
            $this->discount = $discount;
            $this->finalAmount = $finalAmount;
            $this->pointsEarned = $pointsEarned;
            $this->invoiceDate = $invoiceDate;
        }

        public function getId(){ return $this->id; }
        public function getInvoiceCode(){ return $this->invoiceCode; }
        public function getCustomerId(){ return $this->customerId; }
        public function getTotalAmount(){ return $this->totalAmount; }
        public function getPointsUsed(){ return $this->pointsUsed; }
        public function getDiscount(){ return $this->discount; }
        public function getFinalAmount(){ return $this->finalAmount; }
        public function getPointsEarned(){ return $this->pointsEarned; }
        public function getInvoiceDate(){ return $this->invoiceDate; }
    };
?>
