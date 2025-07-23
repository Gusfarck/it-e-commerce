<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body style="background: linear-gradient(to right,rgba(255, 253, 255, 1),rgba(58, 58, 58, 1));">
    <?php include './components/header.php'; ?>

    <section id="fetch_product" class="py-5">
        <div class="container">
            <h2 class="mb-4">แสดงข้อมูลสินค้า</h2>
            <div class="container mt-5">
                <div class="row">
                        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                            <ul class="list-group">
                                <?php foreach ($_SESSION['cart'] as $item): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <img src="./assets/imgs/<?= htmlspecialchars($item['productImage']); ?>" alt="" class="rounded-5" style="width: 100px; height: 100px; object-fit: cover;">
                                            <div class="ms-3 w-100">
                                                <h5 class="mb-1"><?= htmlspecialchars($item['productName']); ?></h5>
                                                <p class="mb-1">Price: <?= htmlspecialchars($item['productPrice']); ?> บาท</p>
                                                <p class="mb-1">Quantity: <?= htmlspecialchars($item['quantity']); ?></p>
                                            </div>
                                        </div>
                                        
                    
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button class="btn btn-success">
                                            <i class="bi bi-plus-circle-fill"></i>เพิ่ม
                                        </button>
                                        <button class="btn btn-warning">
                                            <i class="bi bi-dash-circle"></i>ลด
                                        </button>
                                        <button class="btn btn-danger">
                                            <i class="bi bi-trash-fill"></i>ลบ
                                        </button>
                                    </div>
                            <?php endforeach ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-center">ไม่มีสินค้าในตะกร้า</p>
                        <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php include './components/footer.php'; ?>
</body>

</html>