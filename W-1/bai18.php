<?php
// bai18.php
session_start();
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = []; // mỗi phần tử: ['name' => '...', 'score' => 0..10]
}

$err = null;

// Thêm sinh viên
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'add') {
    $name = trim($_POST['name'] ?? '');
    $score_raw = trim($_POST['score'] ?? '');

    if ($name === '') {
        $err = "Họ tên không được để trống.";
    } elseif (!is_numeric($score_raw)) {
        $err = "Điểm phải là số.";
    } else {
        $score = (float) $score_raw;
        if ($score < 0 || $score > 10) {
            $err = "Điểm phải trong khoảng 0..10.";
        } else {
            $_SESSION['students'][] = ['name' => $name, 'score' => $score];
        }
    }
}

// Xóa toàn bộ danh sách (tùy chọn)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'clear') {
    $_SESSION['students'] = [];
}

$students = $_SESSION['students'];

// Tính điểm cao nhất
$maxScore = null;
$tops = [];
if (!empty($students)) {
    $scores = array_column($students, 'score');
    $maxScore = max($scores);
    foreach ($students as $s) {
        if ($s['score'] == $maxScore) {
            $tops[] = $s;
        }
    }
}
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Bài 18 - DS Sinh viên</title>
    <style>
        table {
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid #999;
            padding: 6px 10px;
        }

        .highlight {
            background: #fffae6;
        }
    </style>
</head>

<body>

    <form method="post" style="margin-bottom:1rem;">
        <input type="hidden" name="action" value="add">
        <label>Họ tên: <input name="name" required></label>
        <label>Điểm: <input type="number" name="score" step="0.1" min="0" max="10" required></label>
        <button type="submit">Thêm</button>
    </form>

    <form method="post" onsubmit="return confirm('Xóa toàn bộ danh sách?');" style="margin-bottom:1rem;">
        <input type="hidden" name="action" value="clear">
        <button type="submit">Xóa toàn bộ</button>
    </form>

    <?php if ($err): ?>
        <p style="color:red"><?= htmlspecialchars($err) ?></p>
    <?php endif; ?>

    <?php if (!empty($students)): ?>
        <h3>Danh sách sinh viên</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Họ tên</th>
                    <th>Điểm</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $i => $s): ?>
                    <tr class="<?= ($maxScore !== null && $s['score'] == $maxScore) ? 'highlight' : '' ?>">
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($s['name']) ?></td>
                        <td><?= htmlspecialchars($s['score']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Kết quả</h3>
        <p>Điểm cao nhất: <strong><?= htmlspecialchars($maxScore) ?></strong></p>
        <ul>
            <?php foreach ($tops as $t): ?>
                <li><?= htmlspecialchars($t['name']) ?> (<?= htmlspecialchars($t['score']) ?>)</li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Chưa có sinh viên nào. Hãy thêm ở form trên.</p>
    <?php endif; ?>
</body>

</html>