<?php
session_start();
require_once '../includes/connect.php'; // آدرس صحیح فایل اتصال به دیتابیس

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // هش کردن رمز عبور برای امنیت
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, 'user')");
        $stmt->execute([$email, $hashed_password]);
        header("Location: ../login.php");
        exit;
    } catch (PDOException $e) {
        echo "خطا: ایمیل قبلاً ثبت شده است.";
    }
}
