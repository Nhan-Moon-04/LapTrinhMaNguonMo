<?php
// bai16.php
$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n_raw = trim($_POST['n'] ?? '');
    if ($n_raw === '' || !is_numeric($n_raw) || (int) $n_raw != $n_raw) {
        $error = "Vui lòng nhập một số nguyên.";
    } else {
        $n = (int) $n_raw;
        if ($n < 1) {
            $error = "N phải là số nguyên dương (>= 1).";
        } else {
            // Tổng 1..N = N*(N+1)/2
            $result = $n * ($n + 1) / 2;
        }
    }
}
?>
<!doctype html>
<html lang="vi">


<body>
    <form method="post">
        <label>Nhập N: <input type="number" name="n" required min="1"></label>
        <button type="submit">Tính</button>
    </form>
    <?php if ($error): ?>
        <p style="color:red"><?= htmlspecialchars($error) ?></p>
    <?php elseif ($result !== null): ?>
        <p>Kết quả: <strong><?= (int) $result ?></strong></p>
    <?php endif; ?>
</body>

</html>