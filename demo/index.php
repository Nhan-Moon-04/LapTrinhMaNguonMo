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