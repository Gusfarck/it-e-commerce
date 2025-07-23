<?php
    include 'db.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $depart_name = $_POST['depart_name'];

        $sql = "INSERT INTO department (depart_name) 
        VALUES (?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $depart_name
        ]);
    }
?>