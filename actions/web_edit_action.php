<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['admin'] !== true) {
    header("Location: ../login.php");
    exit();
}

require_once("../includes/connect.php");

$id = intval($_POST['id']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$price = intval($_POST['price']);
$category_id = intval($_POST['category_id']);

// گرفتن اطلاعات فعلی محصول برای حذف تصویر قدیمی در صورت نیاز
$current_query = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
$current_product = mysqli_fetch_assoc($current_query);
$current_image = $current_product['image'];

$new_image_name = $current_image; // پیش‌فرض: تصویر تغییری نکرده

if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_name = time() . '_' . basename($_FILES['image']['name']);
    $target_path = "../assets/images/products/" . $image_name;

    if (move_uploaded_file($image_tmp, $target_path)) {
        // حذف تصویر قبلی
        $old_image_path = "../assets/images/products/" . $current_image;
        if (file_exists($old_image_path)) {
            unlink($old_image_path);
        }
        $new_image_name = $image_name;
    }
}

// به‌روزرسانی اطلاعات محصول
$sql = "UPDATE products 
        SET name = '$name', price = $price, image = '$new_image_name', category_id = $category_id 
        WHERE id = $id";

mysqli_query($conn, $sql);

header("Location: ../admin/management.php");
exit();


