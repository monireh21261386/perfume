<?php
// شروع سشن برای بررسی ورود ادمین
session_start();

// چک کردن اینکه کاربر وارد شده و ادمین هست یا نه
if (!isset($_SESSION['user']) || $_SESSION['admin'] !== true) {
    header("Location: ../login.php");
    exit();
}

require_once("../includes/connect.php");

// گرفتن مقدار جستجو (اگر وجود داشته باشد)
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// گرفتن پارامترهای مرتب‌سازی
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$order = isset($_GET['order']) && $_GET['order'] === 'asc' ? 'asc' : 'desc';

// فقط ستون‌های معتبر اجازه مرتب‌سازی دارند
$allowedSort = ['name', 'price', 'id'];
if (!in_array($sort, $allowedSort)) {
    $sort = 'id';
}

// کوئری برای دریافت محصولات همراه با دسته‌بندی با قابلیت جستجو و مرتب‌سازی
$query = "SELECT p.*, c.name AS category_name 
          FROM products p 
          LEFT JOIN categories c ON p.category_id = c.id ";

if ($search !== '') {
    $query .= "WHERE p.name LIKE '%$search%' ";
}

$query .= "ORDER BY $sort $order";

// اجرای کوئری
$result = mysqli_query($conn, $query);

// تابع ساخت لینک مرتب‌سازی
function sort_link($column, $currentSort, $currentOrder, $search) {
    $nextOrder = ($currentSort === $column && $currentOrder === 'asc') ? 'desc' : 'asc';
    $url = "management.php?sort=$column&order=$nextOrder";
    if ($search !== '') {
        $url .= "&search=" . urlencode($search);
    }
    return $url;
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>مدیریت محصولات</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <style>
        body {
            background-color: #f6f2fa;
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
            background-color: #551f70;
        }
        th a {
            color: #6f2c91;
            text-decoration: none;
        }
        th a:hover {
            text-decoration: underline;
        }
        .table thead {
            background-color: #ece0f3;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">پنل مدیریت محصولات</h2>

    <!-- دکمه افزودن محصول جدید -->
    <div class="mb-3 text-end">
        <a href="web_add.php" class="btn btn-primary">افزودن محصول جدید</a>
    </div>

    <!-- فرم جستجو -->
    <form method="get" action="management.php" class="mb-4 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="جستجو بر اساس نام محصول..." value="<?= htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-outline-primary">جستجو</button>
    </form>

    <!-- جدول نمایش محصولات -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle bg-white">
            <thead>
                <tr>
                    <th>شناسه</th>
                    <th>تصویر</th>
                    <th><a href="<?= sort_link('name', $sort, $order, $search); ?>">نام محصول</a></th>
                    <th><a href="<?= sort_link('price', $sort, $order, $search); ?>">قیمت</a></th>
                    <th>دسته‌بندی</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><img src="../assets/images/products/<?= $row['image']; ?>" width="70" class="img-thumbnail"></td>
                            <td><?= $row['name']; ?></td>
                            <td><?= number_format($row['price']); ?> تومان</td>
                            <td><?= $row['category_name'] ?? 'نامشخص'; ?></td>
                            <td>
                                <a href="web_edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">ویرایش</a>
                                <a href="../actions/web_delete_action.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('آیا مطمئن هستید؟')">حذف</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6">محصولی پیدا نشد.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>



