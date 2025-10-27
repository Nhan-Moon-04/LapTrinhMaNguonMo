<?php
include "db.php";

$sql = "SELECT c.category_name, p.name, p.price
        FROM products p
        JOIN categories c ON p.category_id = c.category_id
        WHERE p.price = (
          SELECT MAX(p2.price) FROM products p2 WHERE p2.category_id = p.category_id
        )";
$result = $conn->query($sql);

echo "<h2>Bài 5: Sản phẩm đắt nhất từng loại</h2>";
echo "<table border='1'><tr><th>Loại hàng</th><th>Sản phẩm</th><th>Giá</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['category_name']}</td><td>{$row['name']}</td><td>{$row['price']}</td></tr>";
}
echo "</table>";

$conn->close();
?>