<?php
session_start();
require_once('../connect.php');


// فقط کاربران لاگین‌شده اجازه دسترسی دارند
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// مقداردهی اولیه سبد خرید اگر وجود نداشت
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>سبد خرید | فروشگاه عطر</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: #fef6ff;
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
        .cart-table img {
            width: 80px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<!-- منوی بالا -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="bi bi-flower1 me-2"></i>فروشگاه عطر</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">خانه</a></li>
                <li class="nav-item"><a class="nav-link" href="products.php">محصولات</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php">سبد خرید</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i> خروج</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- محتوای صفحه -->
<div class="container mt-5">
    <h3 class="text-center mb-4 text-purple">🛒 سبد خرید شما</h3>

    <?php if (empty($_SESSION['cart'])): ?>
        <div class="alert alert-warning text-center">سبد خرید شما خالی است.</div>
    <?php else: ?>
        <table class="table cart-table table-bordered table-striped text-center align-middle">
            <thead class="table-secondary">
                <tr>
                    <th>تصویر</th>
                    <th>نام محصول</th>
                    <th>قیمت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $itemId):
                    $res = mysqli_query($conn, "SELECT * FROM products WHERE id = $itemId");
                    if ($row = mysqli_fetch_assoc($res)):
                        $total += $row['price'];
                ?>
                <tr>
                    <td><img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="" /></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= number_format($row['price']) ?> تومان</td>
                    <td>
                        <a href="remove_from_cart.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> حذف
                        </a>
                    </td>
                </tr>
                <?php endif; endforeach; ?>
                <tr>
                    <td colspan="2" class="text-end"><strong>جمع کل:</strong></td>
                    <td colspan="2" class="text-start text-danger"><strong><?= number_format($total) ?> تومان</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="checkout.php" class="btn btn-purple"><i class="bi bi-cash-coin"></i> ادامه فرایند پرداخت</a>
        </div>
    <?php endif; ?>
</div>

<!-- فوتر -->
<div class="footer mt-5 p-3 text-center">
    <p>&copy; <?= date('Y') ?> فروشگاه عطر</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
