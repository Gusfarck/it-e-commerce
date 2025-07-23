<?php
    include './controls/db.php';
    

    // ดึงข้อมูลผู้ใช้งานจาก database
    $sql = "SELECT * FROM `users`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
?>