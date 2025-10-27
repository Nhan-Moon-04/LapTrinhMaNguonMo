<?php
include "db.php";

$sql = "SELECT c.customer_id, c.name, SUM(od.quantity * od.price) AS total_spent
        FROM customers c
        JOIN orders o ON c.customer_id = o.customer_id
        JOIN order_details od ON o.order_id = od.order_id
        GROUP BY c.customer_id, c.name
        HAVING total_spent > 1000000";
$result = $conn->query($sql);

echo "<h2>Bài 4: Khách hàng chi tiêu > 1.000.000</h2>";
echo "<table border='1'><tr><th>ID</th><th>Tên</th><th>Tổng chi tiêu</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['customer_id']}</td><td>{$row['name']}</td><td>{$row['total_spent']}</td></tr>";
}
echo "</table>";

$conn->close();
?>