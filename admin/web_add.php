<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['admin'] !== true) {
    header("Location: ../login.php");
    exit();
}
require_once("../includes/connect.php");

// گرفتن دسته‌ها برای نمایش در فرم
$cat_result = mysqli_query($conn, "SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>افزودن محصول</title>
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
    <h2 class="text-center mb-4">افزودن محصول جدید</h2>

    <form action="../actions/web_add_action.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">نام محصول:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">قیمت (تومان):</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">دسته‌بندی:</label>
            <select name="category_id" class="form-select" required>
                <option value="">انتخاب کنید</option>
                <?php while ($cat = mysqli_fetch_assoc($cat_result)): ?>
                    <option value="<?= $cat['id']; ?>"><?= htmlspecialchars($cat['name']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">تصویر محصول:</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary">ذخیره</button>
    </form
