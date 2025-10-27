<?php
// Kết nối database cho hệ thống shop
$dsn = "mysql:host=localhost;dbname=lab3_shop;charset=utf8mb4";
$username = "root";
$password = "";

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    die("Lỗi kết nối database: " . $e->getMessage());
}
?>