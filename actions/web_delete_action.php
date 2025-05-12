<?php
session_start();

// فقط ادمین مجازه
if (!isset($_SESSION['user']) || $_SESSION['admin'] !== true) {
    header("Location: ../login.php");
    exit();
}

require_once("../includes/connect.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // گرفتن نام عکس برای حذف
    $getImageQuery = "SELECT image FROM products WHERE id = $id";
    $imgResult = mysqli_query($conn, $getImageQuery);
    $imgData = mysqli_fetch_assoc($imgResult);
    $imageName = $imgData['image'];

    // حذف عکس از سرور
    $imagePath = "../assets/images/products/" . $imageName;
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    // حذف محصول از دیتابیس
    $sql = "DELETE FROM products WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../admin/management.php?delete=success");
        exit();
    } else {
        echo "خطا در حذف محصول: " . mysqli_error($conn);
    }
} else {
    echo "شناسه محصول ارسال نشده!";
}
?>

