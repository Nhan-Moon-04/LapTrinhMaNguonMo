<?php
// bai19.php
$noteFile = __DIR__ . '/note.txt';
$msg = null;
$err = null;

// Ghi note
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save') {
    $content = trim($_POST['content'] ?? '');
    if ($content === '') {
        $err = "Nội dung không được trống.";
    } else {
        $line = "[" . date('Y-m-d H:i:s') . "] " . $content . PHP_EOL;
        // Ghi nối, khóa file để tránh race condition
        $ok = @file_put_contents($noteFile, $line, FILE_APPEND | LOCK_EX);
        if ($ok === false) {
            $err = "Không thể ghi vào file. Kiểm tra quyền ghi thư mục.";
        } else {
            $msg = "Đã lưu.";
        }
    }
}

// Xóa file
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'clear') {
    if (file_exists($noteFile)) {
        @unlink($noteFile);
        $msg = "Đã xóa note.txt.";
    } else {
        $msg = "Không có file để xóa.";
    }
}

$all = file_exists($noteFile) ? file_get_contents($noteFile) : '';
?>
<!doctype html>
<html lang="vi">


<body>


    <form method="post">
        <input type="hidden" name="action" value="save">
        <label>Nội dung:</label><br>
        <textarea name="content" rows="4" cols="70" required></textarea><br>
        <button type="submit">Lưu</button>
    </form>

    <form method="post" style="margin-top:0.5rem" onsubmit="return confirm('Xóa toàn bộ nội dung note.txt?');">
        <input type="hidden" name="action" value="clear">
        <button type="submit">Xóa file</button>
    </form>

    <?php if ($msg): ?>
        <p style="color:green"><?= htmlspecialchars($msg) ?></p><?php endif; ?>
    <?php if ($err): ?>
        <p style="color:red"><?= htmlspecialchars($err) ?></p><?php endif; ?>

    <h3>Nội dung đã lưu (note.txt)</h3>
    <pre style="white-space:pre-wrap; word-wrap:break-word; background:#f7f7f7; padding:10px;">
<?= htmlspecialchars($all) ?>
</pre>
</body>

</html>