<?php
session_start();
require_once('../connect.php');


// فقط کاربران لاگین‌شده دسترسی دارند
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// اگر سبد خرید خالی بود، هدایت به cart
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

// محاسبه مجموع قیمت سبد خرید
$total = 0;
$items = [];

foreach ($_SESSION['cart'] as $itemId) {
    $res = mysqli_query($conn, "SELECT * FROM products WHERE id = $itemId");
    if ($row = mysqli_fetch_assoc($res)) {
        $total += $row['price'];
        $items[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پرداخت | فروشگاه عطر</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: #fdf6ff;
        }
        .navbar, .footer {
            background-color: #6f2c91;
            color: white;
        }
        .nav-link, .navbar-brand {
            color: white !important;
        }
        .btn-purple {
            background-color: #6f2c91;
            color: white;
        }
        .btn-purple:hover {
            background-color: #5a2373;
        }
    </style>
</head>
<body>

<!-- منو -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="bi bi-flower1 me-2"></i>فروشگاه عطر</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="logout.php">خروج</a></li>
        </ul>
    </div>
</nav>

<!-- محتوا -->
<div class="container mt-5">
    <h3 class="text-center mb-4">🧾 اطلاعات پرداخت</h3>

    <form method="post" action="checkout_action.php">
        <div class="row mb-3">
            <div class="col-md-6">
                <label>نام و نام خانوادگی</label>
                <input type="text" name="fullname" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>شماره تماس</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>آدرس کامل</label>
            <textarea name="address" class="form-control" rows="3" required></textarea>
        </div>

        <div class="alert alert-info">
            مبلغ قابل پرداخت: <strong><?= number_format($total) ?> تومان</strong>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-purple"><i class="bi bi-credit-card-2-front"></i> پرداخت</button>
        </div>
    </form>
</div>

<!-- فوتر -->
<div class="footer mt-5 p-3 text-center">
    <p>&copy; <?= date('Y') ?> فروشگاه عطر</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
