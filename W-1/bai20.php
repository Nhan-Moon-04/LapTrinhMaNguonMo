<?php
// bai20.php
$cookieName = 'username';
$greetingName = $_COOKIE[$cookieName] ?? null;
$notice = null;

// Lưu tên vào Cookie
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save') {
    $name = trim($_POST['name'] ?? '');
    if ($name === '') {
        $notice = "Tên không được trống.";
    } else {
        // Hết hạn sau 30 ngày
        $expiry = time() + 30 * 24 * 60 * 60;
        // Từ PHP 7.3 có mảng options:
        $options = [
            'expires' => $expiry,
            'path' => '/',
            'httponly' => true,
            // 'secure' => true, // bật khi dùng HTTPS
            'samesite' => 'Lax',
        ];
        setcookie($cookieName, $name, $options);
        // Sau khi set cookie, cập nhật biến hiện tại
        $greetingName = $name;
        $notice = "Đã ghi nhớ tên của bạn.";
    }
}

// Xóa Cookie
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'forget') {
    $options = [
        'expires' => time() - 3600,
        'path' => '/',
        'httponly' => true,
        // 'secure' => true,
        'samesite' => 'Lax',
    ];
    setcookie($cookieName, '', $options);
    $greetingName = null;
    $notice = "Đã quên bạn. Vui lòng nhập lại tên.";
}
?>
<!doctype html>
<html lang="vi">



<body>


    <?php if ($notice): ?>
        <p style="color:green"><?= htmlspecialchars($notice) ?></p>
    <?php endif; ?>

    <?php if ($greetingName): ?>
        <p>Xin chào, <strong><?= htmlspecialchars($greetingName) ?></strong>! Rất vui được gặp lại bạn 👋</p>
        <form method="post" style="margin-top:1rem;">
            <input type="hidden" name="action" value="forget">
            <button type="submit">Quên tôi (xóa Cookie)</button>
        </form>
    <?php else: ?>
        <p>Chào mừng bạn! Đây là lần đầu truy cập hoặc Cookie đã bị xoá.</p>
        <form method="post">
            <input type="hidden" name="action" value="save">
            <label>Nhập tên của bạn: <input name="name" required></label>
            <button type="submit">Ghi nhớ</button>
        </form>
    <?php endif; ?>
</body>

</html>