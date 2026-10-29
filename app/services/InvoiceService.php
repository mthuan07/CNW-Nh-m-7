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
            $id = (int)$id;
            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();

                if($conn != null){
                    $sql = "SELECT * FROM invoices WHERE id = '$id'";
                    $stmt = $conn->query($sql);
                    if($stmt->rowCount() > 0){
                        $row = $stmt->fetch();
                        $invoice = new Invoice($row['id'],$row['invoice_code'],$row['customer_id'],$row['total_amount'],$row['points_used'],$row['discount'],$row['final_amount'],$row['points_earned'],$row['invoice_date']);
                        return $invoice;
                    }
                }
            }
        }

        public function getInvoiceItemsByInvoiceId($id){
            $id = (int)$id;
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
            $id = (int)$id;
            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();

                if($conn != null){
                    $sql = "SELECT inventory.product_name FROM invoice_items INNER JOIN inventory ON invoice_items.inventory_id = inventory.id WHERE invoice_items.invoice_id = '$id'";
                    $stmt = $conn->query($sql);
                    $productNames = '';
                    while($row = $stmt->fetch()){
                        if($productNames != ''){
                            $productNames .= ', ';
                        }
                        $productNames .= $row['product_name'];
                    }
                    return $productNames;
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
            $id = (int)$id;
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
            $id = (int)$id;
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

        public function addInvoice($phone,$pointsUsed,$inventoryIds,$quantities){
            $inventory = $this->getAllInventory();
            if($inventory === null){
                return 'Không thể kết nối cơ sở dữ liệu hoặc chưa có sản phẩm trong kho.';
            }

            if(!is_string($phone)){
                return 'Số điện thoại khách hàng không hợp lệ.';
            }
            if($phone != '' && preg_match('/^[0-9+\-\s()]+$/',$phone) != 1){
                return 'Số điện thoại khách hàng không hợp lệ.';
            }
            $items = [];
            $selectedQuantity = [];
            $totalAmount = 0;
            foreach($inventoryIds as $key => $inventoryId){
                if($inventoryId == ''){
                    continue;
                }
                if(!is_numeric($inventoryId) || (float)$inventoryId != (int)$inventoryId || !isset($quantities[$key]) || !is_numeric($quantities[$key]) || (float)$quantities[$key] <= 0){
                    return 'Vui lòng nhập số lượng lớn hơn 0 cho từng sản phẩm đã chọn.';
                }
                $inventoryId = (int)$inventoryId;
                $product = $this->getInventoryById($inventoryId);
                if($product == null){
                    return 'Sản phẩm được chọn không tồn tại.';
                }
                if(!isset($selectedQuantity[$inventoryId])){
                    $selectedQuantity[$inventoryId] = 0;
                }
                $selectedQuantity[$inventoryId] += (float)$quantities[$key];
                if($selectedQuantity[$inventoryId] > (float)$product->getQuantity()){
                    return 'Số lượng sản phẩm '.$product->getProductName().' vượt quá tồn kho.';
                }
                $unitPrice = (float)$product->getPrice();
                $lineTotal = (float)$quantities[$key] * $unitPrice;
                $items[] = ['inventoryId'=>$inventoryId,'quantity'=>(float)$quantities[$key],'unitPrice'=>$unitPrice,'lineTotal'=>$lineTotal];
                $totalAmount += $lineTotal;
            }

            if(count($items) == 0){
                return 'Hóa đơn phải có ít nhất một sản phẩm.';
            }

            $phone = trim($phone);
            $customer = null;
            if($phone != ''){
                $customer = $this->getCustomerByPhone($phone);
                if($customer == null){
                    return 'Không tìm thấy khách hàng theo số điện thoại đã nhập.';
                }
            }

            if($customer == null){
                $pointsUsed = 0;
            }else if(!is_numeric($pointsUsed) || (int)$pointsUsed < 0 || (float)$pointsUsed != (int)$pointsUsed || (int)$pointsUsed > (int)$customer->getPoints()){
                return 'Điểm sử dụng không hợp lệ hoặc vượt quá điểm hiện có.';
            }else{
                $pointsUsed = (int)$pointsUsed;
            }

            $discount = $pointsUsed * POINT_VALUE;
            if($discount > $totalAmount){
                return 'Giảm giá bằng điểm không được vượt quá tổng tiền hóa đơn.';
            }
            $finalAmount = $totalAmount - $discount;
            $pointsEarned = $customer != null ? (int)floor($finalAmount / POINT_EARN_RATE) : 0;

            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();
                if($conn != null){
                    $invoiceCode = uniqid('HD');
                    $customerId = $customer != null ? $customer->getId() : 'NULL';
                    $invoiceDate = date('Y-m-d H:i:s');
                    $sql = "INSERT INTO invoices (invoice_code,customer_id,total_amount,points_used,discount,final_amount,points_earned,invoice_date) VALUES ('$invoiceCode',$customerId,'$totalAmount','$pointsUsed','$discount','$finalAmount','$pointsEarned','$invoiceDate')";
                    $conn->exec($sql);
                    $invoiceId = $conn->lastInsertId();

                    foreach($items as $item){
                        $sql = "INSERT INTO invoice_items (invoice_id,inventory_id,quantity,unit_price,line_total) VALUES ('$invoiceId','".$item['inventoryId']."','".$item['quantity']."','".$item['unitPrice']."','".$item['lineTotal']."')";
                        $conn->exec($sql);
                    }

                    foreach($items as $item){
                        $product = $this->getInventoryById($item['inventoryId']);
                        $this->updateInventoryQuantity($item['inventoryId'],(float)$product->getQuantity() - $item['quantity']);
                    }

                    if($customer != null){
                        $this->updateCustomerPoints($customer->getId(),(int)$customer->getPoints() - $pointsUsed + $pointsEarned);
                    }
                    return '';
                }
            }
            return 'Không thể kết nối cơ sở dữ liệu.';
        }

        public function updateInvoice($id,$phone,$pointsUsed,$inventoryIds,$quantities){
            $invoice = $this->getInvoiceById($id);
            if($invoice == null){
                return 'Không tìm thấy hóa đơn cần sửa.';
            }
            $inventory = $this->getAllInventory();
            if($inventory === null){
                return 'Không thể kết nối cơ sở dữ liệu hoặc chưa có sản phẩm trong kho.';
            }

            $invoiceItems = $this->getInvoiceItemsByInvoiceId($id);
            $oldQuantity = [];
            foreach($invoiceItems as $invoiceItem){
                $inventoryId = $invoiceItem->getInventoryId();
                if(!isset($oldQuantity[$inventoryId])){
                    $oldQuantity[$inventoryId] = 0;
                }
                $oldQuantity[$inventoryId] += (float)$invoiceItem->getQuantity();
            }

            $items = [];
            $selectedQuantity = [];
            $totalAmount = 0;
            foreach($inventoryIds as $key => $inventoryId){
                if($inventoryId == ''){
                    continue;
                }
                if(!is_numeric($inventoryId) || (float)$inventoryId != (int)$inventoryId || !isset($quantities[$key]) || !is_numeric($quantities[$key]) || (float)$quantities[$key] <= 0){
                    return 'Vui lòng nhập số lượng lớn hơn 0 cho từng sản phẩm đã chọn.';
                }
                $inventoryId = (int)$inventoryId;
                $product = $this->getInventoryById($inventoryId);
                if($product == null){
                    return 'Sản phẩm được chọn không tồn tại.';
                }
                if(!isset($selectedQuantity[$inventoryId])){
                    $selectedQuantity[$inventoryId] = 0;
                }
                $selectedQuantity[$inventoryId] += (float)$quantities[$key];
                $availableQuantity = (float)$product->getQuantity() + (isset($oldQuantity[$inventoryId]) ? $oldQuantity[$inventoryId] : 0);
                if($selectedQuantity[$inventoryId] > $availableQuantity){
                    return 'Số lượng sản phẩm '.$product->getProductName().' vượt quá tồn kho.';
                }
                $unitPrice = (float)$product->getPrice();
                $lineTotal = (float)$quantities[$key] * $unitPrice;
                $items[] = ['inventoryId'=>$inventoryId,'quantity'=>(float)$quantities[$key],'unitPrice'=>$unitPrice,'lineTotal'=>$lineTotal];
                $totalAmount += $lineTotal;
            }

            if(count($items) == 0){
                return 'Hóa đơn phải có ít nhất một sản phẩm.';
            }

            if(!is_string($phone)){
                return 'Số điện thoại khách hàng không hợp lệ.';
            }
            if($phone != '' && preg_match('/^[0-9+\-\s()]+$/',$phone) != 1){
                return 'Số điện thoại khách hàng không hợp lệ.';
            }
            $phone = trim($phone);
            $customer = null;
            if($phone != ''){
                $customer = $this->getCustomerByPhone($phone);
                if($customer == null){
                    return 'Không tìm thấy khách hàng theo số điện thoại đã nhập.';
                }
            }

            $customerPoints = $customer != null ? (int)$customer->getPoints() : 0;
            if($customer != null && $invoice->getCustomerId() == $customer->getId()){
                $customerPoints = $customerPoints - (int)$invoice->getPointsEarned() + (int)$invoice->getPointsUsed();
            }
            if($customer == null){
                $pointsUsed = 0;
            }else if(!is_numeric($pointsUsed) || (int)$pointsUsed < 0 || (float)$pointsUsed != (int)$pointsUsed || (int)$pointsUsed > $customerPoints){
                return 'Điểm sử dụng không hợp lệ hoặc vượt quá điểm hiện có.';
            }else{
                $pointsUsed = (int)$pointsUsed;
            }

            $discount = $pointsUsed * POINT_VALUE;
            if($discount > $totalAmount){
                return 'Giảm giá bằng điểm không được vượt quá tổng tiền hóa đơn.';
            }
            $finalAmount = $totalAmount - $discount;
            $pointsEarned = $customer != null ? (int)floor($finalAmount / POINT_EARN_RATE) : 0;

            $oldCustomer = null;
            $oldCustomerPoints = 0;
            if($invoice->getCustomerId() != null){
                $oldCustomer = $this->getCustomerById($invoice->getCustomerId());
                if($oldCustomer == null){
                    return 'Không tìm thấy khách hàng của hóa đơn cũ.';
                }
                $oldCustomerPoints = (int)$oldCustomer->getPoints() - (int)$invoice->getPointsEarned() + (int)$invoice->getPointsUsed();
            }

            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();
                if($conn != null){
                    foreach($invoiceItems as $invoiceItem){
                        $product = $this->getInventoryById($invoiceItem->getInventoryId());
                        $this->updateInventoryQuantity($invoiceItem->getInventoryId(),(float)$product->getQuantity() + (float)$invoiceItem->getQuantity());
                    }

                    if($oldCustomer != null){
                        $this->updateCustomerPoints($oldCustomer->getId(),$oldCustomerPoints);
                    }

                    $customerId = $customer != null ? $customer->getId() : 'NULL';
                    $invoiceDate = date('Y-m-d H:i:s');
                    $sql = "UPDATE invoices SET customer_id = $customerId,total_amount = '$totalAmount',points_used = '$pointsUsed',discount = '$discount',final_amount = '$finalAmount',points_earned = '$pointsEarned',invoice_date = '$invoiceDate' WHERE id = '$id'";
                    $conn->exec($sql);
                    $sql = "DELETE FROM invoice_items WHERE invoice_id = '$id'";
                    $conn->exec($sql);

                    foreach($items as $item){
                        $sql = "INSERT INTO invoice_items (invoice_id,inventory_id,quantity,unit_price,line_total) VALUES ('$id','".$item['inventoryId']."','".$item['quantity']."','".$item['unitPrice']."','".$item['lineTotal']."')";
                        $conn->exec($sql);
                    }

                    foreach($items as $item){
                        $product = $this->getInventoryById($item['inventoryId']);
                        $this->updateInventoryQuantity($item['inventoryId'],(float)$product->getQuantity() - $item['quantity']);
                    }
                    if($customer != null){
                        $this->updateCustomerPoints($customer->getId(),$customerPoints - $pointsUsed + $pointsEarned);
                    }
                    return '';
                }
            }
            return 'Không thể kết nối cơ sở dữ liệu.';
        }

        public function deleteInvoice($id){
            $id = (int)$id;
            $invoice = $this->getInvoiceById($id);
            if($invoice == null){
                return 'Không tìm thấy hóa đơn cần xóa.';
            }
            $invoiceItems = $this->getInvoiceItemsByInvoiceId($id);
            foreach($invoiceItems as $invoiceItem){
                $product = $this->getInventoryById($invoiceItem->getInventoryId());
                $this->updateInventoryQuantity($invoiceItem->getInventoryId(),(float)$product->getQuantity() + (float)$invoiceItem->getQuantity());
            }

            if($invoice->getCustomerId() != null){
                $customer = $this->getCustomerById($invoice->getCustomerId());
                if($customer != null){
                    $this->updateCustomerPoints($customer->getId(),(int)$customer->getPoints() - (int)$invoice->getPointsEarned() + (int)$invoice->getPointsUsed());
                }
            }

            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();
                if($conn != null){
                    $sql = "DELETE FROM invoices WHERE id = '$id'";
                    $conn->exec($sql);
                    return '';
                }
            }
            return 'Không thể kết nối cơ sở dữ liệu.';
        }

        public function updateInventoryQuantity($id,$quantity){
            $id = (int)$id;
            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();

                if($conn != null){
                    $sql = "UPDATE inventory SET quantity = '$quantity' WHERE id = '$id'";
                    $conn->exec($sql);
                }
            }
        }

        public function updateCustomerPoints($id,$points){
            $id = (int)$id;
            $points = (int)$points;
            $dbConnection = new DbConnection();
            if($dbConnection != null){
                $conn = $dbConnection->getConnection();

                if($conn != null){
                    $sql = "UPDATE customers SET points = '$points' WHERE id = '$id'";
                    $conn->exec($sql);
                }
            }
        }
    };
?>
