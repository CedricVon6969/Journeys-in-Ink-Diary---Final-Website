<?php
include('db.php');


session_start();
$_SESSION['user_id'] = $user_id;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $pdo->prepare($query);

    if ($stmt->execute([':username' => $username, ':email' => $email, ':password' => $password])) {
        header("Location: login.php");
    } else {
        $error = "Error signing up. Please try again.";
    }
}
?>
