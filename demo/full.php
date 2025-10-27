Cau 1

<?php
function isPrime($num)
{
    if ($num <= 1)
        return false;
    if ($num == 2)
        return true;
    for ($i = 3; $i <= sqrt($num); $i += 2) {
        if ($num % $i == 0)
            return false;
    }
    return true;


}

for ($i = 1; $i <= 100; $i++) {
    if (isPrime($i)) {
        echo $i . " ";
    }
}
?>

//////////////////////////////////////////////////////////
cau 2
<html>
<?php
class HocSinh
{
    private $MaHS;
    private $TenHS;
    private $DiemVan;
    private $DiemToan;

    function __construct($MaHS, $TenHS, $DiemVan, $DiemToan)
    {
        $this->MaHS = $MaHS;
        $this->TenHS = $TenHS;
        $this->DiemVan = $DiemVan;
        $this->DiemToan = $DiemToan;
    }

    function tinhDiemTrungBinhXepLoaiHocLuc()
    {
        $diemTB = ($this->DiemVan + $this->DiemToan) / 2;
        echo "Điểm trung bình: " . $diemTB . "<br>";

        if ($diemTB >= 9)
            return "Xếp loại học lực: Xuất sắc";
        else if ($diemTB >= 8)
            return "Xếp loại học lực: Giỏi";
        else if ($diemTB >= 7)
            return "Xếp loại học lực: Khá";
        else if ($diemTB >= 5)
            return "Xếp loại học lực: Trung bình";
        else
            return "Xếp loại học lực: Yếu";
    }

}
?>

<body>
    <?php
    $hs = new HocSinh("16112004", "Nguyễn Thiện Nhân", 8, 9);
    echo $hs->tinhDiemTrungBinhXepLoaiHocLuc();
    ?>

</html>


//////////////////////////////////////////////////////////

cau 3
<?php
$dsn = "mysql:host=localhost;dbname=labdbb;charset=utf8";
$username = "root";
$password = "";
try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
}
?>


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

//////////////////////////////////////////////////////////

cau 4
<?php
$host = 'localhost';
$db = 'companydb';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Lỗi kết nối CSDL: " . $e->getMessage();
    exit;
}
?>

``````````````````````````````````````````````````````````

<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách nhân viên</title>
</head>

<body>
    <h2>Danh sách nhân viên</h2>
    <a href="create.php">➕ Thêm nhân viên</a>
    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Chức vụ</th>
            <th>Lương</th>
            <th>Hành động</th>
        </tr>
        <?php
        $stmt = $conn->query("SELECT * FROM employees");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['fullname']}</td>
                    <td>{$row['position']}</td>
                    <td>{$row['salary']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>✏️ Sửa</a> |
                        <a href='delete.php?id={$row['id']}' onclick=\"return confirm('Xóa nhân viên này?')\">🗑️ Xóa</a>
                    </td>
                </tr>";
        }
        ?>
    </table>
</body>

</html>






<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách nhân viên</title>
</head>

<body>
    <h2>Danh sách nhân viên</h2>
    <a href="create.php">➕ Thêm nhân viên</a>
    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Chức vụ</th>
            <th>Lương</th>
            <th>Hành động</th>
        </tr>
        <?php
        $stmt = $conn->query("SELECT * FROM employees");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['fullname']}</td>
                    <td>{$row['position']}</td>
                    <td>{$row['salary']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>✏️ Sửa</a> |
                        <a href='delete.php?id={$row['id']}' onclick=\"return confirm('Xóa nhân viên này?')\">🗑️ Xóa</a>
                    </td>
                </tr>";
        }
        ?>
    </table>
</body>

</html>






<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->execute([$id]);
$emp = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$emp) {
    echo "Không tìm thấy nhân viên!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $stmt = $conn->prepare("UPDATE employees SET fullname=?, position=?, salary=? WHERE id=?");
    $stmt->execute([$fullname, $position, $salary, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa nhân viên</title>
</head>

<body>
    <h2>Sửa thông tin nhân viên</h2>
    <form method="POST">
        Họ tên: <input type="text" name="fullname" value="<?= htmlspecialchars($emp['fullname']) ?>" required><br><br>
        Chức vụ: <input type="text" name="position" value="<?= htmlspecialchars($emp['position']) ?>" required><br><br>
        Lương: <input type="number" step="0.01" name="salary" value="<?= htmlspecialchars($emp['salary']) ?>"
            required><br><br>
        <input type="submit" value="Cập nhật">
    </form>
</body>

</html>


```````````````````````````````````````````````````````
<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm nhân viên</title>
</head>

<body>
    <h2>Thêm nhân viên mới</h2>
    <form method="POST">
        Họ tên: <input type="text" name="fullname" required><br><br>
        Chức vụ: <input type="text" name="position" required><br><br>
        Lương: <input type="number" step="0.01" name="salary" required><br><br>
        <input type="submit" value="Thêm">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fullname = $_POST['fullname'];
        $position = $_POST['position'];
        $salary = $_POST['salary'];

        $stmt = $conn->prepare("INSERT INTO employees (fullname, position, salary) VALUES (?, ?, ?)");
        $stmt->execute([$fullname, $position, $salary]);

        echo "<p>✅ Thêm thành công!</p>";
        echo "<a href='index.php'>← Quay lại danh sách</a>";
    }
    ?>
</body>

</html>

``````````````````````````````````````````````````````````
<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM employees WHERE id=?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;
?>


.//.`````````````````````````````````````````````````````//
<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->execute([$id]);
$emp = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$emp) {
    echo "Không tìm thấy nhân viên!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $stmt = $conn->prepare("UPDATE employees SET fullname=?, position=?, salary=? WHERE id=?");
    $stmt->execute([$fullname, $position, $salary, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa nhân viên</title>
</head>

<body>
    <h2>Sửa thông tin nhân viên</h2>
    <form method="POST">
        Họ tên: <input type="text" name="fullname" value="<?= htmlspecialchars($emp['fullname']) ?>" required><br><br>
        Chức vụ: <input type="text" name="position" value="<?= htmlspecialchars($emp['position']) ?>" required><br><br>
        Lương: <input type="number" step="0.01" name="salary" value="<?= htmlspecialchars($emp['salary']) ?>"
            required><br><br>
        <input type="submit" value="Cập nhật">
    </form>
</body>

</html>






<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM employees WHERE id=?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;
?>




<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm nhân viên</title>
</head>

<body>
    <h2>Thêm nhân viên mới</h2>
    <form method="POST">
        Họ tên: <input type="text" name="fullname" required><br><br>
        Chức vụ: <input type="text" name="position" required><br><br>
        Lương: <input type="number" step="0.01" name="salary" required><br><br>
        <input type="submit" value="Thêm">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fullname = $_POST['fullname'];
        $position = $_POST['position'];
        $salary = $_POST['salary'];

        $stmt = $conn->prepare("INSERT INTO employees (fullname, position, salary) VALUES (?, ?, ?)");
        $stmt->execute([$fullname, $position, $salary]);

        echo "<a href='index.php'>← Quay lại danh sách</a>";
    }
    ?>
</body>

</html>