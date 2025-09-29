<?php
include "db.php";

$sql = "SELECT c.customer_id, c.name, SUM(od.quantity) AS total_items
        FROM customers c
        JOIN orders o ON c.customer_id = o.customer_id
        JOIN order_details od ON o.order_id = od.order_id
        GROUP BY c.customer_id, c.name
        ORDER BY total_items DESC
        LIMIT 1";
$result = $conn->query($sql);

echo "<h2>Bài 7: Khách hàng mua nhiều sản phẩm nhất</h2>";
echo "<table border='1'><tr><th>ID</th><th>Tên</th><th>Tổng sản phẩm</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['customer_id']}</td><td>{$row['name']}</td><td>{$row['total_items']}</td></tr>";
}
echo "</table>";

$conn->close();
?>