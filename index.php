<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>فروشگاه عطر و ادکلن</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      font-family: 'Vazirmatn', sans-serif;
      background-color: #fdf6ff;
    }

    .navbar {
      background-color: #6f2c91;
    }

    .navbar-brand, .nav-link, .nav-item a {
      color: white !important;
    }

    .nav-link:hover {
      color: #ffcef2 !important;
    }

    .hero {
      background: linear-gradient(to right, #6f2c91, #9c27b0);
      color: white;
      padding: 60px 20px;
      text-align: center;
      border-radius: 15px;
      margin-top: 20px;
    }

    .hero h1 {
      font-size: 2.5rem;
      margin-bottom: 20px;
    }

    .product-card {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }

    .product-card:hover {
      transform: translateY(-5px);
    }

    .footer {
      background-color: #6f2c91;
      color: white;
      padding: 20px 0;
      text-align: center;
      margin-top: 40px;
    }
  </style>
</head>
<body>

<!-- 🔝 منو بالا -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="#"><i class="bi bi-flower1 me-2"></i>فروشگاه عطر و ادکلن</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="index.php">خانه</a></li>
        <li class="nav-item"><a class="nav-link" href="products.php">محصولات</a></li>
        <li class="nav-item"><a class="nav-link" href="ebout.php">درباره ما</a></li>
        <li class="nav-item"><a class="nav-link" href="rules.php">قوانین</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">ارتباط با ما</a></li>
        <li class="nav-item"><a class="nav-link" href="cart.php"><i class="bi bi-cart"></i> سبد خرید</a></li>
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

<!-- 💜 بخش خوش‌آمدگویی -->
<div class="container">
  <div class="hero">
    <h1>به دنیای رایحه‌های خاص خوش آمدید</h1>
    <p>با خرید از ما، رایحه‌ی منحصر به‌فرد خود را پیدا کنید</p>
    <a href="products.php" class="btn btn-light mt-3">مشاهده محصولات</a>
  </div>

  <!-- 🌸 محصولات نمونه -->
  <div class="row mt-5">
    <h4 class="mb-4">منتخب محصولات</h4>

    <div class="col-md-4 mb-3">
      <div class="product-card p-3">
        <img src="assets/images/sample1.jpg" class="img-fluid rounded mb-3" alt="perfume">
        <h5>ادکلن مردانه خاص</h5>
        <p>قیمت: ۹۸۰,۰۰۰ تومان</p>
        <a href="product_detail.php?id=1" class="btn btn-outline-primary btn-sm">جزئیات</a>
      </div>
    </div>

    <div class="col-md-4 mb-3">
      <div class="product-card p-3">
        <img src="assets/images/sample2.jpg" class="img-fluid rounded mb-3" alt="perfume">
        <h5>عطر زنانه لاکچری</h5>
        <p>قیمت: ۱,۲۵۰,۰۰۰ تومان</p>
        <a href="product_detail.php?id=2" class="btn btn-outline-primary btn-sm">جزئیات</a>
      </div>
    </div>

    <div class="col-md-4 mb-3">
      <div class="product-card p-3">
        <img src="assets/images/sample3.jpg" class="img-fluid rounded mb-3" alt="perfume">
        <h5>پرفیوم یونی‌سکس</h5>
        <p>قیمت: ۱,۱۰۰,۰۰۰ تومان</p>
        <a href="product_detail.php?id=3" class="btn btn-outline-primary btn-sm">جزئیات</a>
      </div>
    </div>
  </div>
</div>

<!-- 🧾 فوتر -->
<div class="footer">
  <p>تمامی حقوق متعلق به فروشگاه عطر و ادکلن می‌باشد &copy; <?= date('Y'); ?></p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
