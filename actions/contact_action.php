<?php
// اتصال به دیتابیس
require_once 'connect.php';

// بررسی ارسال فرم
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // گرفتن داده‌ها و امن‌سازی
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // اعتبارسنجی ساده
    if ($name && $email && $message) {
        $stmt = $conn->prepare("INSERT INTO messages (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            header("Location: contact.php?status=success");
            exit();
        } else {
            header("Location: contact.php?status=error");
            exit();
        }
    } else {
        header("Location: contact.php?status=invalid");
        exit();
    }
} else {
    header("Location: contact.php");
    exit();
}
