<?php
    session_start();
    include 'db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $first_name =  $_POST['first_name'];
        $last_name =  $_POST['last_name'];
        $address =  $_POST['address'];
        $phone =  $_POST['phone'];
        $email =  $_POST['email'];
        $profile_image = null;

        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
            $target_dir = "../../assets/imgs/";
            $image_name = basename($_FILES["profile_image"]["name"]);
            $target_file = $target_dir . $image_name;   
        }

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                $profile_image = $image_name;
            } else {
                $_SESSION['error'] = "Failed to upload image.";
                header("Location: ../edituser.php?id=" . $id);
                exit;
            }
        } else {
            $_SESSION['error'] = "Invalid image format.";
            header("Location: ../edituser.php?id=" . $id);
            exit;
        }

        $stmt = $pdo->prepare("UPDATE `users` SET `first_name` = ?, `last_name` = ?, `address` = ?, `phone` = ?, `email` = ? " . ($profile_image ? ", profile_image = ? ":""). " WHERE id = ?");
        $params = [$first_name, $last_name, $address, $phone, $email];
        if ($profile_image) {
            $params[] = $profile_image;
        }
        $params[] = $id;
        $result = $stmt->execute($params);

        if ($result) {
            $_SESSION['success'] = "User updated successfully!";
            header("Location: ../user.php");
        } else {
            $_SESSION['error'] = "Failed to update user.";
            header("Location: ../edituser.php?id=" . $id);
        }
        
        exit;
    }
?>