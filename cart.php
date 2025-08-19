<?php
include './controls/fetchDelivery.php';


//เพิ่มจำนวนสินค้าในตะกร้า
if (isset($_POST['action']) && $_POST['action'] == 'increase' && isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    foreach ($_SESSION['cart'] as $key => $item) {  // ใช้ $key เพื่อไม่ให้มีการอ้างอิงโดยตรง
        if ($item['productId'] == $productId) {
            $_SESSION['cart'][$key]['quantity'] += 1;
            break;
        }
    }
}
//ลดจำนวนสินค้าในตะกร้า
if (isset($_POST['action']) && $_POST['action'] == 'decrease' && isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['productId'] == $productId && $item['quantity'] > 1) {
            $_SESSION['cart'][$key]['quantity'] -= 1;
            break;
        }
    }
}
//ลบสินค้าออกจากตะกร้า
if (isset($_POST['action']) && $_POST['action'] == 'remove' && isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['productId'] == $productId) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
}
// คำนวนราคารวม
$totalPrice = 0;
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $item) {
        $totalPrice += $item['productPrice'] * $item['quantity'];
    }
}


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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include './components/header.php'; ?>

    <section id="cart_product" class="flex-grow-1 py-5" style="background: linear-gradient(to right,rgb(142, 65, 197),rgb(75, 161, 231));">
        <div class="container">
            <h2 class="mb-4 text-center fw-bold">ตะกร้าสินค้าของคุณ</h2>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <?php 
                    $total = 0;
                    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                        <ul class="list-group w-100" style="max-width: 900px; margin: auto; background: rgba(255,255,255,0.7); border-radius: 1.5rem;">
                            <?php foreach ($_SESSION['cart'] as $item): 
                                $itemTotal = $item['productPrice'] * $item['quantity'];
                                $total += $itemTotal;
                            ?>
                                <li class="list-group-item mb-2 shadow-sm rounded-4 border-0 px-3 py-2 d-flex flex-row align-items-center justify-content-between" style="background: #fff;">
                                    <div class="d-flex align-items-center">
                                        <img src="./assets/imgs/<?= htmlspecialchars($item['productImage']); ?>" alt="Product Image" class="rounded-4 border" style="width: 70px; height: 70px; object-fit: cover; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                                        <div class="ms-3">
                                            <h6 class="fw-semibold text-primary mb-1" style="font-size: 1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;"> <?= htmlspecialchars($item['productName']); ?> </h6>
                                            <div class="text-secondary" style="font-size: 0.9rem;">ราคา: <span class="fw-bold text-dark"> <?= htmlspecialchars($item['productPrice']); ?> </span> บาท</div>
                                            <div style="font-size: 0.9rem;">จำนวน: <span class="fw-bold text-dark"> <?= htmlspecialchars($item['quantity']); ?> </span></div>
                                            <div style="font-size: 0.9rem;">รวม: <span class="fw-bold text-success"> <?= htmlspecialchars($item['productPrice'] * $item['quantity']); ?> </span> บาท</div>
                                        </div>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form method="post" class="d-inline">
                                            <input type="hidden" name="productId" value="<?= htmlspecialchars($item['productId']); ?>">
                                            <input type="hidden" name="action" value="increase">
                                            <button type="submit" class="btn btn-success btn-sm px-2 py-1 mx-1" style="font-size:0.9rem; border-radius: 1rem;">เพิ่ม</button>
                                        </form>
                                        <form method="post" class="d-inline">
                                            <input type="hidden" name="productId" value="<?= htmlspecialchars($item['productId']); ?>">
                                            <input type="hidden" name="action" value="decrease">
                                            <button type="submit" class="btn btn-warning btn-sm px-2 py-1 mx-1" style="font-size:0.9rem; border-radius: 1rem;">ลด</button>
                                        </form>
                                        <form method="post" class="d-inline" onsubmit="return confirmDelete(event);">
                                            <input type="hidden" name="productId" value="<?= htmlspecialchars($item['productId']); ?>">
                                            <input type="hidden" name="action" value="remove">
                                            <button type="submit" class="btn btn-danger btn-sm px-2 py-1 mx-1" style="font-size:0.9rem; border-radius: 1rem;">ลบ</button>
                                        </form>
                                    </div>
                                </li>
                            <?php endforeach ?>
                        </ul>
                        <!-- แสดงราคาสุทธิ -->
                        <div class="mt-4 p-4 bg-white rounded-4 shadow-sm" style="max-width: 600px; margin: auto;">
                            <h4 class="fw-bold mb-3">ราคารวม: <span class="text-success"><?= number_format($totalPrice, 2) ?></span> บาท</h4>
                            <?php if (!empty($address)): ?>
                                <div class="alert alert-info mb-0" style="font-size: 1.1rem;">
                                    <strong>ที่อยู่จัดส่ง:</strong><br>
                                    <?= nl2br(htmlspecialchars($address)); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- ข้อมูลผู้รับ -->
                        <?php if(isset($row)): ?>
                        <div class="mt-4 p-4 bg-light rounded-4 shadow-sm" style="max-width: 600px; margin: 24px auto 0 auto;">
                            <h5 class="fw-bold mb-2 text-primary">Delivery Information</h5>
                            <div class="mb-1"><strong>ชื่อ-นามสกุล:</strong> <?= htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']); ?></div>
                            <div class="mb-1"><strong>ที่อยู่:</strong> <?= htmlspecialchars($row['address']); ?></div>
                            <div class="mb-1"><strong>โทร:</strong> <?= htmlspecialchars($row['phone']); ?></div>
                            <div class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($row['email']); ?></div>
                        </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="text-center fs-4 text-muted">ไม่มีสินค้าในตะกร้า</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php include './components/footer.php'; ?>

    <script>
        function confirmDelete(event) {
            event.preventDefault();
            const form = event.target;
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณต้องการลบสินค้านี้ออกจากตะกร้าหรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
</body>

</html>