<?php
// รวมการเชื่อมต่อฐานข้อมูล
include './controls/db1.php';
session_start();

// ดึงข้อมูลสินค้าจากตาราง products
$sql = "SELECT `id`, `product_name`, `description`, `price`, `created_at`, `profile_name` FROM `products`";
$stmt = $pdo->prepare($sql); // ใช้ PDO ในการเตรียมค าสั่ง SQL
$stmt->execute(); // รันคำสั่ง SQL
