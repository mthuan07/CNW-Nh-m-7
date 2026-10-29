<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Cửa Hàng Tạp Hóa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="fas fa-store"></i> TẠP HÓA GROCERY</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php?controller=inventory&action=index"><i class="fas fa-boxes"></i> Kho</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?controller=invoice&action=index"><i class="fas fa-file-invoice-dollar"></i> Hóa đơn</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?controller=goodsReceipt&action=index"><i class="fas fa-truck-loading"></i> Nhập hàng</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?controller=customer&action=index"><i class="fas fa-users"></i> Khách hàng</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mb-5"></div>