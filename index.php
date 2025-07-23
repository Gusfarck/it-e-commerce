<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Website</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include './components/header.php'; ?>
    <!-- <p><?php echo htmlspecialchars($_SESSION['name']); ?></p>
    <p><?php echo htmlspecialchars($_SESSION['email']); ?></p> -->
    <!-- hero section -->
    <section class="hero text-white text-center py-5" style="background: linear-gradient(to right,rgb(142, 65, 197),rgb(75, 161, 231)); height: 100vh;">
        <div class="container h-100 d-flex flex-column justify-content-center">
            <h1 class="display-4">ยินดีตอนรับสู่เว็บไซต์ของเรา</h1>
            <p class="lead">ค้นพบโลกแห่งเทคโนโลยีสารสนเทศและข่าวสารล่าสุดดกี่ยวกับการพัฒนาเทคโนโลยี</p>
            <a href="#content" class="btn btn-light bth-lg mx-auto">เริ่มต้นตอนนี้</a>
        </div>
    </section>

    <!-- content section -->
    <section id="content" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">เกี่ยวกับเทคโนโลยีสารสนเทศ</h2>
            <p>
                เทคโนโลยีสารสนเทศ (Information Technology หรือ IT)
                เป็นการใช้เทคโนโลยีในการจัดการกับข้อมูลและสารสนเทศเพื่อสนันสนุนการทำงานทางธุรกิจและ
                องค์กรต่างๆ ไม่ว่าจะเป็นการพัฒนาโปรแกรมคอมพิวเตอร์ การจัดการฐานข้อมูล การสื่อสารผ่านเครือข่าย หรือการป้องกันข้อมูลทางไซเบอร์ เทคโนโลยีสารสนเทศมีบทบาทสำคัญในการพัฒนาและขับเครื่อนองค์กรสู่ความสำเร็จในยุคดิจิทัล.
            </p>
            <p>
                เทคโนโลยีสารสนเทศได้มีการพัฒนาอย่างรวดเร็วในช่วงไม่กี่ปีผ่านมาและสามารถปรับตัวให้เข้า
                กับความต้องการของธุรกิจและผู้ใช้งานได้อย่างมีประสิทธิภาพ เช่น การพัฒนาโปรแกรมหรือแอปพลิเคชันใหม่ๆ ที่ช่วยเพิ่มประสิทธิภาพในการทำงาน เช่น การใช้ระบบคลาวด์ (Cloud Computing) หรือการใช้ Big data ในการวิเคราะห์ข้อมูลเพื่อสนับสนุนการตัดสินใจ
            </p>
        </div>


    </section>
<?php include './components/footer.php'; ?>
    <script>
        <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid') : ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid email or password',
                footer: 'Please ry again.'
            });
        <?php endif; ?>

        <?php if (isset($_GET['success']) && $_GET['success'] == 'true') : ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'You have signed in successfully!',
                footer: 'Go Away Teen.'
            });
        <?php endif; ?>
    </script>
</body>

</html>