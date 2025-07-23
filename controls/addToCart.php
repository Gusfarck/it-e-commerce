<?php
    session_start();

    if(isset($_POST['productId'],
        $_POST['productName'],
        $_POST['productPrice'],
        $_POST['productImage']
    )){
        $productId = $_POST['productId'];
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productImage = $_POST['productImage'];

        //พื้นที่สร้างตระกล้าสินค้า
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }

        //ตรวจสอบว่าในตระกล้ามีสินค้าชนืดเดียวกันไหม?
        $found = false;
        foreach($_SESSION['cart'] as &$item) {
            if($item['productId'] == $productId) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }

        //ถ้าไม่มีสินค้าชนิดเดียวกันอยู่ในตระกล้า, เพิ่มสินค้าใหม่เข้าคระกล้าแทน
        if(!$found) {
            $_SESSION['cart'][] = [
                'productId' => $productId,
                'productName' => $productName,
                'productPrice' => $productPrice,
                'productImage' => $productImage,
                'quantity' => 1
            ];
        }
    }
?>