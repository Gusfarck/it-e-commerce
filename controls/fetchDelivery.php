<?php
    include './controls/db.php';
    session_start();

    $sql = "SELECT `first_name`, `last_name`, `address` , `phone`, `email` FROM `users` WHERE `id` = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    
    
