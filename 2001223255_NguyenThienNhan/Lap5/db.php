<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "lab3_shop";

// Kết nối
$conn = new mysqli($host, $user, $pass, $db);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}


$conn->set_charset("utf8");
?>