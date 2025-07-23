<?php
session_start();
include 'db1.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ลบข้อมูลผู้ใช้งานจากตาราง products
    $stmt = $pdo->prepare("DELETE FROM `products` WHERE `id` = ?");
    $result = $stmt->execute([$id]);

    if ($result) {
        $_SESSION['success'] = "Product deleted successfully!";
        header("Location: ../products.php");
    } else {
        $_SESSION['error'] = "Failed to delete product.";
        header("Location: ../products.php");
    }

    exit;
}
?>