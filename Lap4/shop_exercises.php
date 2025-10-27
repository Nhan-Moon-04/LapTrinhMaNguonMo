<?php
// Lab 3: Hệ thống quản lý shop - Tất cả bài tập

// Kiểm tra kết nối database
$dsn = "mysql:host=localhost;dbname=lab3_shop;charset=utf8mb4";
$username = "root";
$password = "";

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $database_connected = true;
} catch (PDOException $e) {
    $database_connected = false;
    $connection_error = $e->getMessage();
}

// Helper function để hiển thị kết quả dạng bảng
function displayTable($title, $data, $description = '')
{
    echo "<div class='exercise-section'>";
    echo "<h3>$title</h3>";
    if ($description) {
        echo "<p class='description'>$description</p>";
    }

    if (!empty($data)) {
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead class='table-dark'>";
        echo "<tr>";
        foreach (array_keys($data[0]) as $column) {
            echo "<th>" . ucfirst(str_replace('_', ' ', $column)) . "</th>";
        }
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        foreach ($data as $row) {
            echo "<tr>";
            foreach ($row as $value) {
                if (is_numeric($value) && $value > 1000) {
                    echo "<td>" . number_format($value) . "</td>";
                } else {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p class='alert alert-info'>Không có dữ liệu</p>";
    }
    echo "</div>";
}

// Function để thực thi và hiển thị SQL
function executeAndDisplay($title, $sql, $description = '')
{
    global $conn;
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        displayTable($title, $result, $description);

        // Hiển thị SQL query
        echo "<div class='sql-query'>";
        echo "<button class='btn btn-sm btn-outline-secondary' onclick='toggleSQL(this)'>Xem SQL</button>";
        echo "<pre class='sql-code' style='display:none;'>" . htmlspecialchars($sql) . "</pre>";
        echo "</div>";

    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Lỗi: " . $e->getMessage() . "</div>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Lab 3: Hệ thống quản lý Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .exercise-section {
            margin-bottom: 40px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f8f9fa;
        }

        .description {
            color: #666;
            font-style: italic;
            margin-bottom: 15px;
        }

        .sql-query {
            margin-top: 10px;
        }

        .sql-code {
            background: #f4f4f4;
            padding: 10px;
            border-radius: 4px;
            font-size: 12px;
            margin-top: 10px;
        }

        .navbar {
            margin-bottom: 30px;
        }

        .toc {
            background: #e9ecef;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .toc ul {
            margin: 0;
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand h1">Lab 3: Hệ thống quản lý Shop - Tất cả bài tập</span>
        </div>
    </nav>

    <div class="container">
        <?php if (!$database_connected): ?>
            <!-- Hiển thị lỗi kết nối database -->
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">❌ Lỗi kết nối database!</h4>
                <p><strong>Lỗi:</strong> <?= htmlspecialchars($connection_error) ?></p>
                <hr>
                <h5>🔧 Cách khắc phục:</h5>
                <ol>
                    <li><strong>Tạo database:</strong> Truy cập phpMyAdmin hoặc MySQL Command Line</li>
                    <li><strong>Import file SQL:</strong> Chạy file <code>shop_database.sql</code></li>
                    <li><strong>Hoặc chạy lệnh SQL sau:</strong></li>
                </ol>

                <div class="bg-light p-3 rounded mt-3">
                    <h6>SQL tạo database:</h6>
                    <pre
                        class="mb-0"><code>CREATE DATABASE lab3_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;</code></pre>
                </div>

                <div class="mt-3">
                    <a href="shop_database.sql" class="btn btn-primary" download>📥 Download shop_database.sql</a>
                    <button class="btn btn-info" onclick="showFullSQL()">📋 Xem toàn bộ SQL</button>
                </div>

                <div id="fullSQL" style="display:none;" class="mt-3">
                    <h6>Toàn bộ SQL để tạo database và dữ liệu:</h6>
                    <pre class="bg-dark text-light p-3 rounded"
                        style="max-height: 400px; overflow-y: auto;"><code><?= htmlspecialchars(file_get_contents('shop_database.sql')) ?></code></pre>
                </div>
            </div>

            <div class="alert alert-info">
                <h5>📖 Hướng dẫn chi tiết:</h5>
                <ol>
                    <li><strong>Sử dụng phpMyAdmin:</strong>
                        <ul>
                            <li>Mở trình duyệt: <code>http://localhost/phpmyadmin</code></li>
                            <li>Click tab "Import"</li>
                            <li>Chọn file <code>shop_database.sql</code></li>
                            <li>Click "Go"</li>
                        </ul>
                    </li>
                    <li><strong>Sử dụng MySQL Command Line:</strong>
                        <ul>
                            <li>Mở CMD/Terminal</li>
                            <li>Chạy: <code>mysql -u root -p < shop_database.sql</code></li>
                        </ul>
                    </li>
                    <li><strong>Reload trang này sau khi tạo database</strong></li>
                </ol>
            </div>

            <script>
                function showFullSQL() {
                    const fullSQL = document.getElementById('fullSQL');
                    if (fullSQL.style.display === 'none') {
                        fullSQL.style.display = 'block';
                    } else {
                        fullSQL.style.display = 'none';
                    }
                }
            </script>

        <?php else: ?>

            <!-- Mục lục -->
            <div class="toc">
                <h4>📋 Mục lục bài tập</h4>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Bài tập tại lớp (01-07):</h5>
                        <ul>
                            <li><a href="#bai01">Bài 01: Thống kê sản phẩm theo loại</a></li>
                            <li><a href="#bai02">Bài 02: Doanh thu theo ngày</a></li>
                            <li><a href="#bai03">Bài 03: Loại hàng >5 sản phẩm</a></li>
                            <li><a href="#bai04">Bài 04: Khách hàng chi tiêu</a></li>
                            <li><a href="#bai05">Bài 05: Sản phẩm đắt nhất</a></li>
                            <li><a href="#bai06">Bài 06: Sản phẩm chưa bán</a></li>
                            <li><a href="#bai07">Bài 07: Khách mua nhiều nhất</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5>Bài ôn luyện (08-12):</h5>
                        <ul>
                            <li><a href="#bai08">Bài 08: Thống kê theo loại sản phẩm</a></li>
                            <li><a href="#bai09">Bài 09: Top 3 sản phẩm bán chạy</a></li>
                            <li><a href="#bai10">Bài 10: Top 5 khách chi tiêu nhiều</a></li>
                            <li><a href="#bai11">Bài 11: Loại hàng doanh thu cao nhất</a></li>
                            <li><a href="#bai12">Bài 12: Sản phẩm và số lần đặt</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php
            // Bài tập 01: Thống kê số lượng sản phẩm trong từng loại hàng
            echo "<div id='bai01'>";
            $sql01 = "SELECT c.category_name, COUNT(p.product_id) AS total_products
                  FROM categories c
                  LEFT JOIN products p ON c.category_id = p.category_id
                  GROUP BY c.category_name";
            executeAndDisplay(
                "Bài 01: Thống kê số lượng sản phẩm trong từng loại hàng",
                $sql01,
                "Sử dụng LEFT JOIN để đảm bảo loại hàng không có sản phẩm vẫn hiện lên."
            );
            echo "</div>";

            // Bài tập 02: Tính tổng doanh thu từng ngày
            echo "<div id='bai02'>";
            $sql02 = "SELECT o.order_date, SUM(od.quantity * od.price) AS total_revenue
                  FROM orders o
                  JOIN order_details od ON o.order_id = od.order_id
                  GROUP BY o.order_date
                  ORDER BY o.order_date";
            executeAndDisplay(
                "Bài 02: Tính tổng doanh thu từng ngày",
                $sql02,
                "Tính tổng tiền = quantity × price, nhóm theo ngày đặt hàng."
            );
            echo "</div>";

            // Bài tập 03: Tìm loại hàng có trên 5 sản phẩm
            echo "<div id='bai03'>";
            $sql03 = "SELECT c.category_name, COUNT(p.product_id) AS total_products
                  FROM categories c
                  JOIN products p ON c.category_id = p.category_id
                  GROUP BY c.category_name
                  HAVING COUNT(p.product_id) > 5";
            executeAndDisplay(
                "Bài 03: Tìm loại hàng có trên 5 sản phẩm",
                $sql03,
                "Sử dụng HAVING để lọc sau khi nhóm dữ liệu (với dữ liệu mẫu hiện tại không có loại nào >5)."
            );
            echo "</div>";

            // Bài tập 04: Danh sách khách hàng và tổng tiền đã mua
            echo "<div id='bai04'>";
            $sql04 = "SELECT c.customer_id, c.name, SUM(od.quantity * od.price) AS total_spent
                  FROM customers c
                  JOIN orders o ON c.customer_id = o.customer_id
                  JOIN order_details od ON o.order_id = od.order_id
                  GROUP BY c.customer_id, c.name
                  HAVING total_spent > 1000000
                  ORDER BY total_spent DESC";
            executeAndDisplay(
                "Bài 04: Khách hàng và tổng tiền đã mua (>1.000.000)",
                $sql04,
                "Chỉ hiển thị khách hàng có tổng chi tiêu trên 1 triệu đồng."
            );
            echo "</div>";

            // Bài tập 05: Tìm sản phẩm có giá cao nhất trong từng loại hàng
            echo "<div id='bai05'>";
            $sql05 = "SELECT c.category_name, p.name, p.price
                  FROM products p
                  JOIN categories c ON p.category_id = c.category_id
                  WHERE p.price = (
                      SELECT MAX(p2.price)
                      FROM products p2
                      WHERE p2.category_id = p.category_id
                  )
                  ORDER BY c.category_name";
            executeAndDisplay(
                "Bài 05: Sản phẩm có giá cao nhất trong từng loại",
                $sql05,
                "Sử dụng subquery để tìm giá cao nhất cho từng loại hàng."
            );
            echo "</div>";

            // Bài tập 06: Liệt kê sản phẩm chưa từng được đặt hàng
            echo "<div id='bai06'>";
            $sql06 = "SELECT p.product_id, p.name, p.price, c.category_name
                  FROM products p
                  JOIN categories c ON p.category_id = c.category_id
                  LEFT JOIN order_details od ON p.product_id = od.product_id
                  WHERE od.product_id IS NULL
                  ORDER BY p.name";
            executeAndDisplay(
                "Bài 06: Sản phẩm chưa từng được đặt hàng",
                $sql06,
                "Sử dụng LEFT JOIN + IS NULL để tìm sản phẩm không có trong order_details."
            );
            echo "</div>";

            // Bài tập 07: Khách hàng mua nhiều sản phẩm nhất
            echo "<div id='bai07'>";
            $sql07 = "SELECT c.customer_id, c.name, c.email, SUM(od.quantity) AS total_items
                  FROM customers c
                  JOIN orders o ON c.customer_id = o.customer_id
                  JOIN order_details od ON o.order_id = od.order_id
                  GROUP BY c.customer_id, c.name, c.email
                  ORDER BY total_items DESC
                  LIMIT 1";
            executeAndDisplay(
                "Bài 07: Khách hàng mua nhiều sản phẩm nhất",
                $sql07,
                "Sắp xếp giảm dần theo tổng số lượng và lấy bản ghi đầu tiên."
            );
            echo "</div>";

            // Bài tập 08: Thống kê tổng số lượng và doanh thu của từng loại sản phẩm
            echo "<div id='bai08'>";
            $sql08 = "SELECT c.category_name, 
                         SUM(od.quantity) AS total_quantity,
                         SUM(od.quantity * od.price) AS total_revenue,
                         COUNT(DISTINCT od.product_id) AS products_sold
                  FROM categories c
                  JOIN products p ON c.category_id = p.category_id
                  JOIN order_details od ON p.product_id = od.product_id
                  GROUP BY c.category_id, c.category_name
                  ORDER BY total_revenue DESC";
            executeAndDisplay(
                "Bài 08: Thống kê tổng số lượng và doanh thu theo loại",
                $sql08,
                "Thống kê chi tiết: số lượng bán, doanh thu và số sản phẩm đã bán theo từng loại."
            );
            echo "</div>";

            // Bài tập 09: Tìm 3 sản phẩm bán chạy nhất
            echo "<div id='bai09'>";
            $sql09 = "SELECT p.product_id, p.name, c.category_name, 
                         SUM(od.quantity) AS total_sold,
                         SUM(od.quantity * od.price) AS revenue
                  FROM products p
                  JOIN categories c ON p.category_id = c.category_id
                  JOIN order_details od ON p.product_id = od.product_id
                  GROUP BY p.product_id, p.name, c.category_name
                  ORDER BY total_sold DESC
                  LIMIT 3";
            executeAndDisplay(
                "Bài 09: Top 3 sản phẩm bán chạy nhất",
                $sql09,
                "Sắp xếp theo tổng số lượng bán ra và lấy 3 sản phẩm đầu tiên."
            );
            echo "</div>";

            // Bài tập 10: Liệt kê 5 khách hàng chi tiêu nhiều nhất
            echo "<div id='bai10'>";
            $sql10 = "SELECT c.customer_id, c.name, c.email,
                         COUNT(DISTINCT o.order_id) AS total_orders,
                         SUM(od.quantity) AS total_items,
                         SUM(od.quantity * od.price) AS total_spent
                  FROM customers c
                  JOIN orders o ON c.customer_id = o.customer_id
                  JOIN order_details od ON o.order_id = od.order_id
                  GROUP BY c.customer_id, c.name, c.email
                  ORDER BY total_spent DESC
                  LIMIT 5";
            executeAndDisplay(
                "Bài 10: Top 5 khách hàng chi tiêu nhiều nhất",
                $sql10,
                "Hiển thị thông tin chi tiết: số đơn hàng, số sản phẩm và tổng chi tiêu."
            );
            echo "</div>";

            // Bài tập 11: Tìm loại hàng có doanh thu cao nhất
            echo "<div id='bai11'>";
            $sql11 = "SELECT c.category_name,
                         COUNT(DISTINCT p.product_id) AS total_products,
                         SUM(od.quantity) AS total_quantity,
                         SUM(od.quantity * od.price) AS total_revenue
                  FROM categories c
                  JOIN products p ON c.category_id = p.category_id
                  JOIN order_details od ON p.product_id = od.product_id
                  GROUP BY c.category_id, c.category_name
                  ORDER BY total_revenue DESC
                  LIMIT 1";
            executeAndDisplay(
                "Bài 11: Loại hàng có doanh thu cao nhất",
                $sql11,
                "Tìm loại hàng mang lại doanh thu cao nhất."
            );
            echo "</div>";

            // Bài tập 12: Liệt kê tất cả sản phẩm và số lần được đặt hàng
            echo "<div id='bai12'>";
            $sql12 = "SELECT p.product_id, p.name, c.category_name, p.price,
                         COALESCE(SUM(od.quantity), 0) AS total_ordered,
                         COALESCE(COUNT(DISTINCT od.order_id), 0) AS order_count
                  FROM products p
                  JOIN categories c ON p.category_id = c.category_id
                  LEFT JOIN order_details od ON p.product_id = od.product_id
                  GROUP BY p.product_id, p.name, c.category_name, p.price
                  ORDER BY total_ordered DESC, p.name";
            executeAndDisplay(
                "Bài 12: Tất cả sản phẩm và số lần được đặt",
                $sql12,
                "Hiển thị tất cả sản phẩm kể cả chưa được đặt (= 0). Sử dụng COALESCE để thay NULL = 0."
            );
            echo "</div>";
            ?>

            <div class="mt-5 p-4 bg-light rounded">
                <h4>📊 Tổng kết</h4>
                <p>Hệ thống đã hoàn thành <strong>12 bài tập</strong> về SQL với các kỹ thuật:</p>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>✅ <strong>JOIN</strong> (INNER, LEFT JOIN)</li>
                            <li>✅ <strong>GROUP BY</strong> và <strong>HAVING</strong></li>
                            <li>✅ <strong>Aggregate functions</strong> (COUNT, SUM, MAX)</li>
                            <li>✅ <strong>Subquery</strong> (truy vấn con)</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <li>✅ <strong>ORDER BY</strong> và <strong>LIMIT</strong></li>
                            <li>✅ <strong>COALESCE</strong> xử lý NULL</li>
                            <li>✅ <strong>IS NULL</strong> tìm dữ liệu thiếu</li>
                            <li>✅ <strong>Prepared Statement</strong> bảo mật</li>
                        </ul>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    </div>

    <script>
        function toggleSQL(button) {
            const sqlCode = button.nextElementSibling;
            if (sqlCode.style.display === 'none') {
                sqlCode.style.display = 'block';
                button.textContent = 'Ẩn SQL';
            } else {
                sqlCode.style.display = 'none';
                button.textContent = 'Xem SQL';
            }
        }

        // Smooth scroll cho anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>