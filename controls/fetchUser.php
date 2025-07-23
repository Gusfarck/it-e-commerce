<?php
    include './controls/db.php';
    session_start();

    // ดึงข้อมูลผู้ใช้งานจาก database
    $sql = "SELECT `id`, `first_name`, `last_name`, `address`, `phone`, `email`, `password`, `created_at`, `profile_image` FROM `users`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
?>