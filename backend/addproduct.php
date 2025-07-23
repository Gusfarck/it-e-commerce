<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /itweb/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มสินค้า</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/itweb/assets/css/style.css">
    <style>
        body {
            background: linear-gradient(to right, rgb(142, 65, 197), rgb(75, 161, 231));
        }

        .card {
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.12);
            border-radius: 18px;
        }

        .form-label {
            font-weight: 500;
        }

        .img-preview {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            margin-bottom: 1rem;
            border-radius: 8px;
            display: none;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh; max-width: 900px;">
        <div class="card w-100 p-4">
            <div class="row g-0">
                <div class="col-md-6 mx-auto">
                    <div class="card-body">
                        <h2 class="text-center mb-4" style="color:#7c3aed;font-weight:700;">เพิ่มสินค้า</h2>
                        <form method="POST" action="controls/addProduct.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-control rounded-3 border-primary" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control rounded-3 border-primary" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" name="price" class="form-control rounded-3 border-primary" required>
                            </div>
                            <div class="mb-3">
                                <label for="profile_image" class="form-label">Image</label>
                                <input type="file" name="profile_image" class="form-control rounded-3 border-primary" accept="image/*"
                                    onchange="previewImage(event)" required>
                                <img id="imgPreview" class="img-preview border border-2 border-primary" alt="Preview">
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1 rounded-pill">บันทึกสินค้า</button>
                                <button type="reset" class="btn btn-danger flex-grow-1 rounded-pill" onclick="resetPreview()">รีเซ็ต</button>
                                <a href="product.php" class="btn btn-secondary flex-grow-1 rounded-pill">ย้อนกลับ</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="../assets/imgs/sea1.jpg" class="img-fluid rounded-4 shadow" style="object-fit: cover; width: 100%; height: 100%"
                        alt="Robux gif">
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imgPreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }

        function resetPreview() {
            const preview = document.getElementById('imgPreview');
            preview.src = '';
            preview.style.display = 'none';
        }
    </script>
    <?php if (isset($_SESSION['success'])) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'สำเร็จ',
            text: '<?= $_SESSION['success']; ?>',
            confirmButtonText: 'ตกลง'
        });
    </script>
    <?php unset($_SESSION['success']);
endif; ?>
    <?php if (isset($_SESSION['error'])) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'ผิดพลาด',
            text: '<?= $_SESSION['error']; ?>',
            confirmButtonText: 'ตกลง'
        });
    </script>
    <?php unset($_SESSION['error']);
endif; ?>
</body>

</html>