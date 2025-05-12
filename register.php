<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>

<!-- فرم ثبت‌نام -->
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ثبت‌نام</title>
</head>
<body>
    <h2>فرم ثبت‌نام</h2>
    <link rel="stylesheet" href="assets/css/auth.css">
    <form action="actions/register_action.php" method="post">
        <label>ایمیل:</label>
        <input type="email" name="email" required><br>

        <label>رمز عبور:</label>
        <input type="password" name="password" required><br>

        <button type="submit">ثبت‌نام</button>
    </form>
</body>
</html>

