<?php
session_start();
include 'db1.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = trim($_POST['product_name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $profile_name = null;

    if (isset($_FILES['profile_name']) && $_FILES['profile_name']['error'] == 0) {
        $target_dir = "../../assets/imgs/";
        $image_name = basename($_FILES["profile_name"]["name"]);
        $target_file = $target_dir . $image_name;

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($_FILES["profile_name"]["tmp_name"], $target_file)) {
                $profile_name = $image_name;
            } else {
                $_SESSION['error'] = "Sorry, there was an error uploading your file.";
                header("Location: ../addproduct.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "Invalid file type. Only JPG, JPEG, PNG & GIF files are allowed.";
            header("Location: ../addproduct.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Please upload an image file.";
        header("Location: ../addproduct.php");
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO products (profile_name, product_name, description, price) VALUES (?, ?, ?, ?)");
    $result = $stmt->execute([$profile_name, $product_name, $description, $price]);

    if ($result) {
        $_SESSION['success'] = "Product added successfully!";
        header("Location: ../products.php");
    } else {
        $_SESSION['error'] = "Failed to add product.";
        header("Location: ../addproduct.php");
    }     
    exit;
}
?>