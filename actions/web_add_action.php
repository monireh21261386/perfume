<?php
session_start();

// بررسی ورود و سطح دسترسی ادمین
if (!isset($_SESSION['user']) || $_SESSION['admin'] !== true) {
    header("Location: ../login.php");
    exit();
}

require_once("../includes/connect.php");

// گرفتن داده‌های ارسالی از فرم
$name = mysqli_real_escape_string($conn, $_POST['name']);
$price = intval($_POST['price']);
$category_id = intval($_POST['category_id']);

// بررسی اینکه فایل تصویر ارسال شده یا نه
if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_name = time() . '_' . basename($_FILES['image']['name']);
    $target_path = "../assets/images/products/" . $image_name;

    // انتقال فایل به پوشه محصولات
    if (move_uploaded_file($image_tmp, $target_path)) {
        // کوئری درج محصول جدید در دیتابیس
        $sql = "INSERT INTO products (name, price, image, category_id) VALUES ('$name', $price, '$image_name', $category_id)";
        mysqli_query($conn, $sql);

        header("Location: ../admin/management.php");
        exit();
    } else {
        echo "خطا در آپلود تصویر.";
    }
} else {
    echo "لطفاً یک تصویر انتخاب کنید.";
}

