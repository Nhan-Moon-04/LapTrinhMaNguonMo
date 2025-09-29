<?php
include "db.php";

$sql = "SELECT c.category_name, COUNT(p.product_id) AS total_products
        FROM categories c
        JOIN products p ON c.category_id = p.category_id
        GROUP BY c.category_name
        HAVING COUNT(p.product_id) > 5";
$result = $conn->query($sql);

echo "<h2>Bài 3: Loại hàng có trên 5 sản phẩm</h2>";
echo "<table border='1'><tr><th>Loại hàng</th><th>Số lượng</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['category_name']}</td><td>{$row['total_products']}</td></tr>";
}
echo "</table>";

$conn->close();
?>