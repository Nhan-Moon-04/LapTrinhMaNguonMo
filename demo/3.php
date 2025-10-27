<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $quantity = trim($_POST['quantity']);

    if (!empty($name) && is_numeric($price) && is_numeric($quantity)) {
        $sql = "UPDATE products SET name = :name, price = :price, quantity = :quantity WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':price' => $price,
            ':quantity' => $quantity

        ]);
        header('Location: product_list.php');
        exit;
    } else {
        $error = "Vui lòng điền đầy đủ và đúng định dạng!";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <!-- <h2>Sửa sản phẩm</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="post">
        <input type="hidden" name="id" value="<?= isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '' ?>">



        <div class="mb-3">
            <label for="name" class="form-label
">Tên sản phẩm:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá:</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>

        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Số lượng:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="product_list.php" class="btn btn-secondary">Hủy</a>
    </form> -->



    <table>
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
        </tr>
        <?php
        $stmt = $conn->query("SELECT * FROM products");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['price'] > 10) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['price']}</td>";
                echo "<td>{$row['quantity']}</td>";
                echo "</tr>";
            }
        }


        ?>
    </table>

</body>

</html>