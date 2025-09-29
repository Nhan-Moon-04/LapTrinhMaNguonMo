<?php
require 'connect.php';
$stmt = $conn->query("SELECT * FROM students");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Danh sách sinh viên</h2>
<a href="add_student.php">Thêm sinh viên</a>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>Xoá</th>
        <th>Sửa</th>
    </tr>
    <?php foreach ($students as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><a href="delete_student.php?id=<?= $row['id'] ?>" onclick="return
confirm('Xóa?')">Xóa</a></td>
            <td><a href="edit_student.php?id=<?= $row['id'] ?>">Sửa</a></td>
        </tr>
    <?php endforeach; ?>
</table>