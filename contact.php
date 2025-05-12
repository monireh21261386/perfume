<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>ارتباط با ما | فروشگاه عطر</title>
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
    }
    .footer {
      background-color: #6f2c91;
      color: white;
      padding: 20px;
      text-align: center;
      margin-top: 50px;
    }
    .icon-box i {
      font-size: 30px;
      color: #6f2c91;
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
        <li class="nav-item"><a class="nav-link active" href="#">ارتباط با ما</a></li>
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

<!-- فرم تماس -->
<div class="container mt-5">
  <h3 class="section-title text-center mb-4">ارتباط با ما</h3>

  <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <div class="alert alert-success">پیام شما با موفقیت ارسال شد.</div>
  <?php elseif (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
    <div class="alert alert-danger">خطا در ارسال پیام. لطفاً دوباره تلاش کنید.</div>
  <?php elseif (isset($_GET['status']) && $_GET['status'] == 'invalid'): ?>
    <div class="alert alert-warning">لطفاً تمام فیلدها را کامل کنید.</div>
  <?php endif; ?>

  <div class="row">
    <!-- اطلاعات تماس -->
    <div class="col-md-5 mb-4">
      <div class="p-3 bg-white rounded shadow-sm">
        <p><i class="bi bi-geo-alt icon-box me-2"></i> آدرس: تهران، خیابان مثال، پلاک ۱۲۳</p>
        <p><i class="bi bi-telephone icon-box me-2"></i> تلفن: ۰۲۱-۱۲۳۴۵۶۷۸</p>
        <p><i class="bi bi-envelope icon-box me-2"></i> ایمیل: info@perfume-shop.ir</p>
      </div>
    </div>

    <!-- فرم تماس -->
    <div class="col-md-7 mb-4">
      <form class="bg-white p-4 rounded shadow-sm" method="post" action="action/contact_action.php">
        <div class="mb-3">
          <label for="name" class="form-label">نام</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">ایمیل</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">پیام شما</label>
          <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">ارسال پیام</button>
      </form>
    </div>
  </div>
</div>

<!-- فوتر -->
<div class="footer">
  <p>&copy; <?= date('Y') ?> تمامی حقوق برای فروشگاه عطر محفوظ است.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
