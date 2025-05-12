<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>درباره ما | فروشگاه عطر</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      font-family: 'Vazirmatn', sans-serif;
      background-color: #fff6ff;
    }
    .navbar {
      background-color: #6f2c91;
    }
    .navbar-brand, .nav-link {
      color: white !important;
    }
    .nav-link:hover {
      color: #ffe6fb !important;
    }
    .section-title {
      color: #6f2c91;
      border-bottom: 2px solid #6f2c91;
      display: inline-block;
      padding-bottom: 5px;
      margin-bottom: 20px;
    }
    .footer {
      background-color: #6f2c91;
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: 50px;
    }
    .about-box {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 25px;
      box-shadow: 0 0 10px rgba(111, 44, 145, 0.1);
      line-height: 2;
    }
  </style>
</head>
<body>

<!-- منو -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php"><i class="bi bi-flower1 me-2"></i>فروشگاه عطر</a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">خانه</a></li>
        <li class="nav-item"><a class="nav-link" href="products.php">محصولات</a></li>
             <li class="nav-item"><a class="nav-link" href="ebout.php">درباره ما</a></li>
        <li class="nav-item"><a class="nav-link" href="rules.php">قوانین</a></li>
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

<!-- محتوای صفحه درباره ما -->
<div class="container mt-5">
  <h3 class="section-title text-center">درباره فروشگاه ما</h3>
  <div class="about-box mt-4">
    <p>فروشگاه عطر ما با هدف ارائه بهترین و خاص‌ترین رایحه‌ها تأسیس شده است. ما تلاش می‌کنیم با ارائه مجموعه‌ای متنوع از عطرهای زنانه و مردانه از برندهای معتبر دنیا، تجربه‌ای بی‌نظیر برای مشتریان‌مان فراهم کنیم.</p>
    <p>در فروشگاه ما کیفیت، اصل‌بودن کالا، و رضایت مشتری اولویت اصلی است. همچنین تیم پشتیبانی همیشه در کنار شماست تا هرگونه سؤال یا مشکلی را به‌سرعت برطرف کند.</p>
    <p>از اینکه ما را برای خرید عطر انتخاب می‌کنید، سپاسگزاریم 💜</p>
  </div>
</div>

<!-- فوتر -->
<div class="footer mt-5">
  <p>&copy; <?= date('Y') ?> تمامی حقوق برای فروشگاه عطر محفوظ است.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

