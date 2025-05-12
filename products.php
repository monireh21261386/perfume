<?php
session_start();
require_once("connect.php");



// گرفتن دسته‌ها
$categories = mysqli_query($conn, "SELECT * FROM categories");

// گرفتن محصولات (با فیلتر دسته‌بندی در صورت وجود)
$where = "";
if (isset($_GET['cat']) && is_numeric($_GET['cat'])) {
  $cat_id = intval($_GET['cat']);
  $where = "WHERE category_id = $cat_id";
}
$products = mysqli_query($conn, "SELECT * FROM products $where ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>محصولات | فروشگاه عطر</title>
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
    .product-card {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 0 8px rgba(111, 44, 145, 0.1);
      padding: 10px;
      transition: transform 0.3s ease;
    }
    .product-card:hover {
      transform: scale(1.03);
    }
    .product-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 8px;
    }
    .category-list a {
      text-decoration: none;
      color: #6f2c91;
      font-weight: bold;
    }
    .category-list a:hover {
      text-decoration: underline;
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

<!-- منو -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php"><i class="bi bi-flower1 me-2"></i>فروشگاه عطر</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">خانه</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">محصولات</a></li>
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

<!-- محتوای محصولات -->
<div class="container mt-5">
  <div class="row">
    <!-- دسته‌بندی‌ها -->
    <div class="col-md-3">
      <h5 class="text-center text-purple mb-4">دسته‌بندی محصولات</h5>
      <ul class="list-group category-list">
        <li class="list-group-item"><a href="products.php">همه محصولات</a></li>
        <?php while ($cat = mysqli_fetch_assoc($categories)): ?>
          <li class="list-group-item">
            <a href="products.php?cat=<?= $cat['id'] ?>"><?= htmlspecialchars($cat['title']) ?></a>
          </li>
        <?php endwhile; ?>
      </ul>
    </div>

    <!-- لیست محصولات -->
    <div class="col-md-9">
      <div class="row">
        <?php while ($product = mysqli_fetch_assoc($products)): ?>
          <div class="col-md-4 mb-4">
            <div class="product-card">
              <img src="uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>">
              <h6 class="mt-2"><?= htmlspecialchars($product['title']) ?></h6>
              <p class="text-muted"><?= htmlspecialchars($product['price']) ?> تومان</p>
              <?php if (isset($_SESSION['user'])): ?>
                <button class="btn btn-outline-primary w-100"><i class="bi bi-cart-plus"></i> افزودن به سبد</button>
              <?php else: ?>
                <a href="login.php" class="btn btn-outline-secondary w-100">ورود برای خرید</a>
              <?php endif; ?>
            </div>
          </div>
        <?php endwhile; ?>
        <?php if (mysqli_num_rows($products) == 0): ?>
          <p class="text-center text-danger">محصولی یافت نشد.</p>
        <?php endif; ?>
      </div>
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
