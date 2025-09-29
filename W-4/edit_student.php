<?php
require 'connect.php';

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM students WHERE id=?");
    $stmt->execute([$_GET['id']]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $birthday = $_POST['birthday'];

    if (!empty($name) && !empty($email) && !empty($phone)) {
        $stmt = $conn->prepare("UPDATE students SET name=?, email=?, phone=?, birthday=? WHERE id=?");
        $stmt->execute([
            $name,
            $email,
            $phone,
            !empty($birthday) ? $birthday : null,
            $_POST['id']
        ]);
        header("Location: pagination.php");
        exit;
    } else {
        $error = "Vui lòng điền đầy đủ thông tin!";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cập nhật sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <h2>Cập nhật thông tin sinh viên</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="id" value="<?= $student['id'] ?>">

        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên:</label>
            <input type="text" class="form-control" id="name" name="name"
                value="<?= htmlspecialchars($student['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email"
                value="<?= htmlspecialchars($student['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại:</label>
            <input type="text" class="form-control" id="phone" name="phone"
                value="<?= htmlspecialchars($student['phone']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="birthday" class="form-label">Ngày sinh:</label>
            <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $student['birthday'] ?>">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="pagination.php" class="btn btn-secondary">Quay lại</a>
    </form>
</body>

</html>