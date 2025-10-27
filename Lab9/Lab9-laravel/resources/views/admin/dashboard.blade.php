<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .admin-header {
            background-color: #dc3545;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }
        .stat-number {
            font-size: 2em;
            font-weight: bold;
            color: #007bff;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <h1>🛡️ Khu vực quản trị Admin</h1>
        <p>Chào mừng {{ auth()->user()->name }} đến với trang quản trị!</p>
    </div>

    <div class="stats">
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Article::count() }}</div>
            <div>Tổng số bài viết</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\User::count() }}</div>
            <div>Tổng số người dùng</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\User::where('is_admin', true)->count() }}</div>
            <div>Admin</div>
        </div>
    </div>

    <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h3>Chức năng quản trị</h3>
        <p>Chỉ có admin mới có thể:</p>
        <ul>
            <li>✅ Truy cập trang này (/admin)</li>
            <li>✅ Xóa bài viết của bất kỳ ai</li>
            <li>✅ Quản lý hệ thống</li>
        </ul>

        <h4>Demo Middleware & Throttle:</h4>
        <a href="{{ route('articles.index') }}" class="btn">Về danh sách bài viết</a>
        <a href="/api/public-info" class="btn" target="_blank">Test API Throttle (5 requests/min)</a>
        
        <br><br>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Đăng xuất</button>
        </form>
    </div>

    <div style="margin-top: 20px; padding: 15px; background-color: #d1ecf1; border: 1px solid #bee5eb; border-radius: 4px;">
        <h4>Thông tin test:</h4>
        <p><strong>Admin:</strong> admin@example.com / password</p>
        <p><strong>User thường:</strong> user@example.com / password</p>
    </div>
</body>
</html>