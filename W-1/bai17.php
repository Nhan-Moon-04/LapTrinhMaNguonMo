<?php
// bai17.php
mb_internal_encoding('UTF-8');

function viet_hoa_toan_bo(string $str): string
{
    return mb_strtoupper($str, 'UTF-8');
}

$output = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_POST['input'] ?? '';
    $output = viet_hoa_toan_bo($input);
}
?>
<!doctype html>
<html lang="vi">


<body>
    <form method="post">
        <label>Chuỗi đầu vào:</label><br>
        <textarea name="input" rows="4" cols="60"
            required><?= isset($_POST['input']) ? htmlspecialchars($_POST['input']) : '' ?></textarea><br>
        <button type="submit">Chuyển sang VIẾT HOA</button>
    </form>

    <?php if ($output !== ''): ?>
        <h3>Kết quả:</h3>
        <pre><?= htmlspecialchars($output) ?></pre>
    <?php endif; ?>
</body>

</html>