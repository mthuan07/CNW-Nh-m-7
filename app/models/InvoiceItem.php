<?php
    class InvoiceItem{
        private $id;
        private $invoiceId;
        private $inventoryId;
        private $quantity;
        private $unitPrice;
        private $lineTotal;

        public function __construct($id,$invoiceId,$inventoryId,$quantity,$unitPrice,$lineTotal)
        {
            $this->id = $id;
            $this->invoiceId = $invoiceId;
            $this->inventoryId = $inventoryId;
            $this->quantity = $quantity;
            $this->unitPrice = $unitPrice;
            $this->lineTotal = $lineTotal;
        }

        public function getId(){ return $this->id; }
        public function getInvoiceId(){ return $this->invoiceId; }
        public function getInventoryId(){ return $this->inventoryId; }
        public function getQuantity(){ return $this->quantity; }
        public function getUnitPrice(){ return $this->unitPrice; }
        public function getLineTotal(){ return $this->lineTotal; }
    };
?>
