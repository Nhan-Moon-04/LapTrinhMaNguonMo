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

        echo "<p>✅ Thêm thành công!</p>";
        echo "<a href='index.php'>← Quay lại danh sách</a>";
    }
    ?>
</body>

</html>