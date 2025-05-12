<?php
session_start();
require_once "connect.php";

// بررسی اینکه ID معتبر وجود داره
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: products.php");
    exit;
}

$id = intval($_GET['id']);

// گرفتن اطلاعات محصول از دیتابیس
$query = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
if (mysqli_num_rows($query) == 0) {
    echo "<p style='color:red; text-align:center;'>محصولی با این مشخصات پیدا نشد.</p>";
    exit;
}
$product = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['title']) ?> | فروشگاه عطر</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: #fef6ff;
        }
        .navbar {
            background-color: #6f2c91;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .product-image {
            width: 100%;
            border-radius: 10px;
            object-fit: cover;
            height: 400px;
        }
        .btn-purple {
            background-color: #6f2c91;
            color: white;
        }
        .btn-purple:hover {
            background-color: #5a2373;
        }
        .footer {
            background-color: #6f2c91;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
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
          <li class="nav-item"><a class="nav-link" href="ebout.php">درباره ما</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">ارتباط با ما</a></li>
      </ul>
      <ul class="navbar-nav">
        <?php if (!isset($_SESSION['user'])): ?>
          <li class="nav-item"><a class="nav-link" href="login.php"><i class="bi bi-box-arrow-in-right"></i> ورود</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php"><i class="bi bi-person-plus"></i> ثبت‌نام</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i> خروج</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- محتوای جزئیات محصول -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>" class="product-image">
        </div>
        <div class="col-md-6">
            <h3 class="text-purple"><?= htmlspecialchars($product['title']) ?></h3>
            <p class="text-muted"><?= htmlspecialchars($product['description']) ?></p>
            <h5 class="text-danger"><?= number_format($product['price']) ?> تومان</h5>
            <?php if (isset($_SESSION['user'])): ?>
                <button class="btn btn-purple mt-3"><i class="bi bi-cart-plus"></i> افزودن به سبد خرید</button>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline-secondary mt-3">برای خرید وارد شوید</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- فوتر -->
<div class="footer">
    <p>&copy; <?= date('Y') ?> فروشگاه عطر</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
