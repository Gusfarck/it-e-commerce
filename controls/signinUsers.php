<?php
    include 'db.php';
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $password = $_POST['pass'];

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $email
        ]);

        if($stmt->rowCount() > 0){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['name'] = $user['first_name'] . " " . $user['last_name'];
                $_SESSION['role'] = $user['role'];
                header("Location: ../index.php?success=true");
                echo "SignIn Success";
            } else {
                header("Location: ../signin.php?error=invalid");
                echo "SignIn Error";
            }
        } else {
            header("Location: ../signin.php?error=invalid");
        }
    }
?>