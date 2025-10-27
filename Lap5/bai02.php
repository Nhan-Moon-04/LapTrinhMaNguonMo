<?php
include "db.php";

$sql = "SELECT o.order_date, SUM(od.quantity * od.price) AS total_revenue
        FROM orders o
        JOIN order_details od ON o.order_id = od.order_id
        GROUP BY o.order_date";
$result = $conn->query($sql);

echo "<h2>Bài 2: Doanh thu từng ngày</h2>";
echo "<table border='1'><tr><th>Ngày</th><th>Tổng doanh thu</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['order_date']}</td><td>{$row['total_revenue']}</td></tr>";
}
echo "</table>";

$conn->close();
?>