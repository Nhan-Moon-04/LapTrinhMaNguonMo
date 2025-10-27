<?php
include "db.php";

$sql = "SELECT c.category_name, COUNT(p.product_id) AS total_products
        FROM categories c
        LEFT JOIN products p ON c.category_id = p.category_id
        GROUP BY c.category_name";
$result = $conn->query($sql);

echo "<h2>Bài 1: Số lượng sản phẩm trong từng loại</h2>";
echo "<table border='1'><tr><th>Loại hàng</th><th>Số lượng</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['category_name']}</td><td>{$row['total_products']}</td></tr>";
}
echo "</table>";

$conn->close();
?>