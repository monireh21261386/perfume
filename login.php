<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>

<!-- فرم ورود -->
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ورود</title>
</head>
<body>
    <h2>فرم ورود</h2>
    <link rel="stylesheet" href="assets/css/auth.css">
    <form action="actions/login_action.php" method="post">
        <label>ایمیل:</label>
        <input type="email" name="email" required><br>

        <label>رمز عبور:</label>
        <input type="password" name="password" required><br>

        <button type="submit">ورود</button>
    </form>
</body>
</html>
