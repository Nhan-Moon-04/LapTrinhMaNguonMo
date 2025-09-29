<?php
require 'connect.php';

// Lấy từ khóa tìm kiếm
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

// Lấy tham số sắp xếp
$sort = isset($_GET['sort']) && in_array($_GET['sort'], ['name', 'email', 'birthday']) ? $_GET['sort'] : 'id';
$order = isset($_GET['order']) && $_GET['order'] === 'asc' ? 'ASC' : 'DESC';

// Thiết lập phân trang
$limit = 5; // số bản ghi mỗi trang
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
// Truy vấn tổng số bản ghi (có áp dụng tìm kiếm)
$sqlCount = "SELECT COUNT(*) FROM students WHERE name LIKE :keyword OR email LIKE :keyword";
$stmtCount = $conn->prepare($sqlCount);
$stmtCount->execute([':keyword' => "%$keyword%"]);
$totalRecords = $stmtCount->fetchColumn();
$totalPages = ceil($totalRecords / $limit);
// Truy vấn dữ liệu có phân trang và tìm kiếm
$sql = "SELECT * FROM students
WHERE name LIKE :keyword OR email LIKE :keyword
ORDER BY $sort $order
LIMIT :limit OFFSET :offset";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Function để tạo link sắp xếp
function getSortLink($column, $currentSort, $currentOrder, $keyword)
{
    $newOrder = ($currentSort === $column && $currentOrder === 'ASC') ? 'DESC' : 'ASC';
    return "?keyword=" . urlencode($keyword) . "&sort=$column&order=" . strtolower($newOrder) . "&page=1";
}

// Function để hiển thị icon sắp xếp
function getSortIcon($column, $currentSort, $currentOrder)
{
    if ($currentSort === $column) {
        return $currentOrder === 'ASC' ? ' ↑' : ' ↓';
    }
    return '';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sortable {
            cursor: pointer;
            user-select: none;
        }

        .sortable:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body class="container mt-4">
    <h2>Danh sách sinh viên</h2>
    <!-- Form tìm kiếm -->
    <form method="get" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>" class="form-control"
                placeholder="Nhập tên hoặc email cần tìm">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
        <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
        <input type="hidden" name="order" value="<?= htmlspecialchars($order) ?>">
    </form>
    <a href="add_student.php" class="btn btn-success mb-3">Thêm sinh viên</a>
    <!-- Bảng hiển thị dữ liệu -->
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th class="sortable" onclick="location.href='<?= getSortLink('name', $sort, $order, $keyword) ?>'">
                    Họ và tên<?= getSortIcon('name', $sort, $order) ?>
                </th>
                <th class="sortable" onclick="location.href='<?= getSortLink('email', $sort, $order, $keyword) ?>'">
                    Email<?= getSortIcon('email', $sort, $order) ?>
                </th>
                <th>Số điện thoại</th>
                <th class="sortable" onclick="location.href='<?= getSortLink('birthday', $sort, $order, $keyword) ?>'">
                    Ngày sinh<?= getSortIcon('birthday', $sort, $order) ?>
                </th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($students): ?>
                <?php foreach ($students as $index => $row): ?>
                    <tr>
                        <td><?= $offset + $index + 1 ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td><?= $row['birthday'] ? date('d/m/Y', strtotime($row['birthday'])) : 'Chưa cập nhật' ?></td>
                        <td>
                            <a href="edit_student.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                            <a href="delete_student.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Không có dữ liệu</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <!-- Phân trang -->
    <nav>
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link"
                        href="?keyword=<?= urlencode($keyword) ?>&sort=<?= $sort ?>&order=<?= $order ?>&page=1">Đầu</a></li>
                <li class="page-item"><a class="page-link"
                        href="?keyword=<?= urlencode($keyword) ?>&sort=<?= $sort ?>&order=<?= $order ?>&page=<?= $page - 1 ?>">Trước</a>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link"
                        href="?keyword=<?= urlencode($keyword) ?>&sort=<?= $sort ?>&order=<?= $order ?>&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <?php if ($page < $totalPages): ?>
                <li class="page-item"><a class="page-link"
                        href="?keyword=<?= urlencode($keyword) ?>&sort=<?= $sort ?>&order=<?= $order ?>&page=<?= $page + 1 ?>">Sau</a>
                </li>
                <li class="page-item"><a class="page-link"
                        href="?keyword=<?= urlencode($keyword) ?>&sort=<?= $sort ?>&order=<?= $order ?>&page=<?= $totalPages ?>">Cuối</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</body>

</html>