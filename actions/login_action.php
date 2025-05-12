<?php
session_start();
require_once("../includes/connect.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // بررسی وجود کاربر با این ایمیل
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // اگر رمز درست بود
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        // هدایت بسته به نقش
        if ($user['role'] === 'admin') {
            header("Location:../admin/management.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        $error = "ایمیل یا رمز عبور اشتباه است.";
        header("Location: login.php?error=" . urlencode($error));
        exit;
    }
}
?>
