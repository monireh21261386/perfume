<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['admin'] !== true) {
    header("Location: ../login.php");
    exit();
}
require_once("../includes/connect.php");

// گرفتن شناسه محصول
if (!isset($_GET['id'])) {
    header("Location: management.php");
    exit();
}
$id = intval($_GET['id']);

// گرفتن اطلاعات محصول
$product_query = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
$product = mysqli_fetch_assoc($product_query);

// گرفتن دسته‌ها
$cat_result = mysqli_query($conn, "SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ویرایش محصول</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <style>
        body {
            background-color: #f8f0fb;
            font-family: 'Vazirmatn', sans-serif;
        }
        h2 {
            color: #6f2c91;
        }
        .btn-primary {
            background-color: #6f2c91;
            border: none;
        }
        .btn-primary:hover {
            background-color: #4d1e6e;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">ویرایش محصول</h2>

    <form action="../actions/web_edit_action.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product['id']; ?>">

        <div class="mb-3">
            <label class="form-label">نام محصول:</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">قیمت (تومان):</label>
            <input type="number" name="price" class="form-control" value="<?= $product['price']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">دسته‌بندی:</label>
            <select name="category_id" class="form-select" required>
                <?php while ($cat = mysqli_fetch_assoc($cat_result)): ?>
                    <option value="<?= $cat['id']; ?>" <?= ($cat['id'] == $product['category_id']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($cat['name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">تصویر فعلی:</label><br>
            <img src="../assets/images/products/<?= $product['image']; ?>" width="100" class="img-thumbnail">
        </div>

        <div class="mb-3">
            <label class="form-label">تغییر تصویر (اختیاری):</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
    </form>
</div>
</body>
</html>
