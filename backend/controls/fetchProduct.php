<?php
// รวมการเชื่อมต่อฐานข้อมูล
include './controls/db1.php';


// ดึงข้อมูลสินค้าจากตาราง products
$sql = "SELECT * FROM `products`";
$stmt = $pdo->prepare($sql); // ใช้ PDO ในการเตรียมค าสั่ง SQL
$stmt->execute(); // รันคำสั่ง SQL
?>