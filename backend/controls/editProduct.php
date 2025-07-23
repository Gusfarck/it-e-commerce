<?php
session_start();
include 'db1.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $product_image = null;

    if (isset($_FILES['profile_name']) && $_FILES['profile_name']['error'] === 0) {
        $target_dir = "../../assets/imgs/";
        $image_name = basename($_FILES['profile_name']['name']);
        $target_file = $target_dir . $image_name;

        $imagefileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($imagefileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($_FILES['profile_name']['tmp_name'], $target_file)) {
                $profile_name = $image_name;
                $_SESSION['success'] = "Image uploaded successfully!";
            } else {
                $_SESSION['error'] = "Failed to upload image.";
                header("Location: ../editproducts.php?id=" . $id);
                exit;
            }
        } else {
            $_SESSION['error'] = "Invalid image format.";
            header("Location: ../editproducts.php?id=" . $id);
            exit;
        }
    }

    $stmt = $pdo->prepare("UPDATE products SET product_name = ?, description = ?, price = ?" . ($profile_name ? ", profile_name = ?" : "") . " WHERE id = ?");
    $params = [$product_name, $description, $price];
    if ($profile_name) {
        $params[] = $profile_name;
    }
    $params[] = $id;
    $result = $stmt->execute($params);

    if ($result) {
        $_SESSION['success'] = "Product updated successfully!";
        header("Location: ../products.php");
    } else {
        $_SESSION['error'] = "Failed to update product.";
        header("Location: ../editproducts.php?id=" . $id);
    }

    exit;
}