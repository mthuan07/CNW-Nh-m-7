<?php
    require_once APP_ROOT.'/app/models/Invoice.php';
    require_once APP_ROOT.'/app/models/InvoiceItem.php';
    require_once APP_ROOT.'/app/models/Inventory.php';
    require_once APP_ROOT.'/app/models/Customer.php';

    class InvoiceService{
        public function getAllInvoices(){
            $invoices = [];
            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();
                if($conn != null){
                    $sql = "SELECT * FROM invoices ORDER BY invoice_date DESC";
                    $stmt = $conn->query($sql);
                    while($row = $stmt->fetch()){
                        $invoice = new Invoice($row['id'],$row['invoice_code'],$row['customer_id'],$row['total_amount'],$row['points_used'],$row['discount'],$row['final_amount'],$row['points_earned'],$row['invoice_date']);
                        $invoices[] = $invoice;
                    }
                    return $invoices;
                }
            }
        }

        public function getInvoiceById($id){
            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();
                if($conn != null){
                    $sql = "SELECT invoices.*, customers.phone AS customer_phone FROM invoices LEFT JOIN customers ON invoices.customer_id = customers.id WHERE invoices.id = '$id'";
                    $stmt = $conn->query($sql);
                    if($stmt->rowCount() > 0){
                        $row = $stmt->fetch();
                        $invoice = new Invoice($row['id'],$row['invoice_code'],$row['customer_id'],$row['total_amount'],$row['points_used'],$row['discount'],$row['final_amount'],$row['points_earned'],$row['invoice_date'],$row['customer_phone']);
                        return $invoice;
                    }
                }
            }
        }

        public function getInvoiceItemsByInvoiceId($id){
            $invoiceItems = [];
            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();
                if($conn != null){
                    $sql = "SELECT * FROM invoice_items WHERE invoice_id = '$id'";
                    $stmt = $conn->query($sql);
                    while($row = $stmt->fetch()){
                        $invoiceItem = new InvoiceItem($row['id'],$row['invoice_id'],$row['inventory_id'],$row['quantity'],$row['unit_price'],$row['line_total']);
                        $invoiceItems[] = $invoiceItem;
                    }
                    return $invoiceItems;
                }
            }
        }

        public function getInvoiceProductNames($id){
            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();
                if($conn != null){
                    $sql = "SELECT GROUP_CONCAT(inventory.product_name SEPARATOR ', ') AS names FROM invoice_items INNER JOIN inventory ON invoice_items.inventory_id = inventory.id WHERE invoice_id = '$id'";
                    $stmt = $conn->query($sql);
                    $row = $stmt->fetch();
                    return $row['names'];
                }
            }
        }

        public function getAllInventory(){
            $inventory = [];
            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();
                if($conn != null){
                    $sql = "SELECT * FROM inventory ORDER BY product_name";
                    $stmt = $conn->query($sql);
                    while($row = $stmt->fetch()){
                        $product = new Inventory($row['id'],$row['product_code'],$row['product_name'],$row['category'],$row['unit'],$row['price'],$row['quantity'],$row['created_at']);
                        $inventory[] = $product;
                    }
                    return $inventory;
                }
            }
        }

        public function getInventoryById($id){
            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();
                if($conn != null){
                    $sql = "SELECT * FROM inventory WHERE id = '$id'";
                    $stmt = $conn->query($sql);
                    if($stmt->rowCount() > 0){
                        $row = $stmt->fetch();
                        $product = new Inventory($row['id'],$row['product_code'],$row['product_name'],$row['category'],$row['unit'],$row['price'],$row['quantity'],$row['created_at']);
                        return $product;
                    }
                }
            }
        }

        public function getCustomerByPhone($phone){
            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();
                if($conn != null){
                    $sql = "SELECT * FROM customers WHERE phone = '$phone'";
                    $stmt = $conn->query($sql);
                    if($stmt->rowCount() > 0){
                        $row = $stmt->fetch();
                        $customer = new Customer($row['id'],$row['customer_code'],$row['full_name'],$row['phone'],$row['points']);
                        return $customer;
                    }
                }
            }
        }

        public function getCustomerById($id){
            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();
                if($conn != null){
                    $sql = "SELECT * FROM customers WHERE id = '$id'";
                    $stmt = $conn->query($sql);
                    if($stmt->rowCount() > 0){
                        $row = $stmt->fetch();
                        $customer = new Customer($row['id'],$row['customer_code'],$row['full_name'],$row['phone'],$row['points']);
                        return $customer;
                    }
                }
            }
        }

        public function addInvoice($invoice){
            $phone = $invoice->getPhone();
            $inventoryIds = $invoice->getInventoryIds();
            $quantities = $invoice->getQuantities();

            $customer = $this->getCustomerByPhone($phone);
            $customerId = 'NULL';
            $pointsUsed = 0;
            if($customer != null){
                $customerId = $customer->getId();
                $pointsUsed = $invoice->getPointsUsed();
            }

            for($i = 0; $i < count($inventoryIds); $i++){
                if($inventoryIds[$i] != ''){
                    $product = $this->getInventoryById($inventoryIds[$i]);
                    if($quantities[$i] > $product->getQuantity()){
                        return;
                    }
                }
            }

            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();
                if($conn != null){
                    $sql = "INSERT INTO invoices (invoice_code,customer_id,total_amount,points_used,discount,final_amount,points_earned,invoice_date) VALUES ('',$customerId,0,0,0,0,0,NOW())";
                    $conn->exec($sql);
                    $invoiceId = $conn->lastInsertId();

                    $totalAmount = 0;
                    for($i = 0; $i < count($inventoryIds); $i++){
                        if($inventoryIds[$i] != ''){
                            $inventoryId = $inventoryIds[$i];
                            $quantity = $quantities[$i];
                            $product = $this->getInventoryById($inventoryId);
                            $price = $product->getPrice();
                            $lineTotal = $quantity * $price;
                            $totalAmount = $totalAmount + $lineTotal;
                            $sql = "INSERT INTO invoice_items (invoice_id,inventory_id,quantity,unit_price,line_total) VALUES ('$invoiceId','$inventoryId','$quantity','$price','$lineTotal')";
                            $conn->exec($sql);
                            $sql = "UPDATE inventory SET quantity = quantity - $quantity WHERE id = '$inventoryId'";
                            $conn->exec($sql);
                        }
                    }

                    $discount = $pointsUsed * POINT_VALUE;
                    $finalAmount = $totalAmount - $discount;
                    $pointsEarned = 0;
                    if($customer != null){
                        $pointsEarned = floor($finalAmount / POINT_EARN_RATE);
                        $points = $customer->getPoints() - $pointsUsed + $pointsEarned;
                        $sql = "UPDATE customers SET points = '$points' WHERE id = '$customerId'";
                        $conn->exec($sql);
                    }
                    $sql = "UPDATE invoices SET invoice_code = CONCAT('HD', id), total_amount = '$totalAmount', points_used = '$pointsUsed', discount = '$discount', final_amount = '$finalAmount', points_earned = '$pointsEarned' WHERE id = '$invoiceId'";
                    $conn->exec($sql);
                }
            }
        }

        public function updateInvoice($invoice_new){
            $this->deleteInvoice($invoice_new->getId());
            $this->addInvoice($invoice_new);
        }

        public function deleteInvoice($id){
            $invoice = $this->getInvoiceById($id);
            $invoiceItems = $this->getInvoiceItemsByInvoiceId($id);
            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();
                if($conn != null){
                    foreach($invoiceItems as $invoiceItem){
                        $inventoryId = $invoiceItem->getInventoryId();
                        $quantity = $invoiceItem->getQuantity();
                        $sql = "UPDATE inventory SET quantity = quantity + $quantity WHERE id = '$inventoryId'";
                        $conn->exec($sql);
                    }
                    if($invoice->getCustomerId() != null){
                        $customer = $this->getCustomerById($invoice->getCustomerId());
                        $customerId = $customer->getId();
                        $points = $customer->getPoints() - $invoice->getPointsEarned() + $invoice->getPointsUsed();
                        $sql = "UPDATE customers SET points = '$points' WHERE id = '$customerId'";
                        $conn->exec($sql);
                    }
                    $sql = "DELETE FROM invoice_items WHERE invoice_id = '$id'";
                    $conn->exec($sql);
                    $sql = "DELETE FROM invoices WHERE id = '$id'";
                    $conn->exec($sql);
                }
            }
        }
    };
?>
