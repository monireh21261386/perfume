
-- ساخت دیتابیس
CREATE DATABASE IF NOT EXISTS perfume_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE perfume_shop;

-- جدول کاربران
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user'
);

-- جدول دسته‌بندی محصولات
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- جدول محصولات
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    price INT NOT NULL,
    image VARCHAR(255),
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- جدول ارتباط با ما
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- جدول سفارشات
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_price INT NOT NULL,
    address TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- جدول آیتم‌های سفارش
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL DEFAULT 1,
    price INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- افزودن ادمین تستی
INSERT INTO users (email, password, role)
VALUES ('admin@example.com', '$2y$10$4HmwweQkZVqKyo2b7YeOEOSrX4We4PSm2rJmLJwH/6IcrMiEhe7l6', 'admin');
