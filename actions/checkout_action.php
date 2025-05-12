<?php
session_start();
require_once '../includes/connect.php';



// بررسی لاگین بودن کاربر
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

// بررسی خالی نبودن سبد خرید
if (empty($_SESSION['cart'])) {
    header("Location: ../cart.php");
    exit;
}

// گرفتن داده‌های فرم
$fullname = $_POST['fullname'] ?? '';
$phone    = $_POST['phone'] ?? '';
$address  = $_POST['address'] ?? '';

// بررسی اولیه فیلدها
if ($fullname == '' || $phone == '' || $address == '') {
    echo "تمام فیلدها الزامی هستند.";
    exit;
}

// اینجا می‌تونی اطلاعات سفارش رو تو دیتابیس ذخیره کنی (بعداً)
// foreach ($_SESSION['cart'] as $productId) { ... }

// پاک کردن سبد خرید بعد از پرداخت
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پرداخت موفق</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: #fdf6ff;
        }
        .container {
            margin-top: 100px;
        }
        .btn-purple {
            background-color: #6f2c91;
            color: white;
        }
    </style>
</head>
<body>

<div class="container text-center">
    <i class="bi bi-check-circle text-success display-1"></i>
    <h3 class="mt-3">پرداخت با موفقیت انجام شد</h3>
    <p>سفارش شما با موفقیت ثبت شد. با تشکر از خرید شما ❤️</p>
    <a href="../index.php" class="btn btn-purple mt-3">بازگشت به صفحه اصلی</a>
    <a href="../products.php" class="btn btn-outline-secondary mt-2 me-2">مشاهده محصولات</a>
    <a href="../cart.php" class="btn btn-outline-secondary mt-2">سبد خرید</a>
</div>

</body>
</html>
