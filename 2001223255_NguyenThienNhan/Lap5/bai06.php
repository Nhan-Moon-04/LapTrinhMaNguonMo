<?php
include "db.php";

$sql = "SELECT p.product_id, p.name
        FROM products p
        LEFT JOIN order_details od ON p.product_id = od.product_id
        WHERE od.product_id IS NULL";
$result = $conn->query($sql);

echo "<h2>Bài 6: Sản phẩm chưa từng được đặt</h2>";
echo "<table border='1'><tr><th>ID</th><th>Tên sản phẩm</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['product_id']}</td><td>{$row['name']}</td></tr>";
}
echo "</table>";

$conn->close();
?>