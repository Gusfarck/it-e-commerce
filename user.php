<?php include './controls/fetchUser.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="background: linear-gradient(to right,rgb(142, 65, 197),rgb(75, 161, 231));">
    <?php include './components/header.php'; ?>

    <section id="fecth-user" class="py-5">
        <div class="container">
            <h2 class="mb-4">แสดงข้อมูลผู้ใช้งาน</h2>
            <?php if($stmt->rowCount() > 0) : ?>
                <div class="container mt-5">
                    <div class="row">
                        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                            <div class="col-md-4 mb-4">
                                <div class="card rounded-5">
                                    <div class="card-body">
                                        <img src="./assets/imgs/<?= htmlspecialchars($row['profile_image']); ?>" alt="" class="rounded-5" style="width: 100%; height: 100%;">
                                        <div class="card-body">  
                                            <h5 class="card-title"><?php echo htmlspecialchars($row['first_name'] . " " . htmlspecialchars($row['last_name'])) ; ?></h5>
                                            <p class="card-text"><strong>อีเมลล์:</strong><?php echo htmlspecialchars($row['email']) ; ?></p>
                                            <p class="card-text"><strong>เบอน์โทร:</strong><?php echo htmlspecialchars($row['phone']) ; ?></p>
                                            <p class="card-text"><strong>ที่อยู่:</strong><?php echo htmlspecialchars($row['address']) ; ?></p>
                                            <p class="card-text"><strong>วันที่สมัคร:</strong><?php echo htmlspecialchars($row['created_at']) ; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       <?php } ?>
                    </div>
                </div>

            <?php endif  ?>

        </div>
    </section>

    <?php include './components/footer.php'; ?>
</body>
</html>