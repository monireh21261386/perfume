<?php
session_start();

// اطمینان از وجود سبد خرید
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// گرفتن آی‌دی محصول از URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // حذف آیتم از آرایه سبد خرید
    if (($key = array_search($id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
    }
}

// هدایت مجدد به صفحه سبد خرید
header("Location: cart.php");
exit;
?>
