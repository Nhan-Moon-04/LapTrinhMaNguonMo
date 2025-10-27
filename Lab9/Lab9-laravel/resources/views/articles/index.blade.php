<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài viết</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: normal;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            border: 1px solid transparent;
            border-radius: 4px;
            text-decoration: none;
        }
        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Danh sách bài viết</h1>

    <!-- Navigation -->
    <div style="margin-bottom: 20px; padding: 10px; background-color: #f8f9fa; border-radius: 4px;">
        @auth
            <span>Xin chào, <strong>{{ auth()->user()->name }}</strong></span>
            @if(auth()->user()->is_admin)
                <span style="color: #dc3545; font-weight: bold;">(Admin)</span>
            @endif
            |
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: #007bff; cursor: pointer; text-decoration: underline;">Đăng xuất</button>
            </form>
        @else
            <a href="{{ route('login') }}" style="color: #007bff; text-decoration: none;">Đăng nhập</a> |
            <a href="{{ route('register') }}" style="color: #007bff; text-decoration: none;">Đăng ký</a>
        @endauth
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('debug'))
        <div class="alert alert-success" style="background-color: #fff3cd; border-color: #ffeaa7; color: #856404;">
            Debug: {{ session('debug') }}
        </div>
    @endif

    @auth
        <a href="{{ route('articles.create') }}" class="btn btn-primary">Tạo bài viết mới</a>
    @else
        <p style="color: #666;">Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để tạo bài viết.</p>
    @endauth

    @if($articles->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Tags</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td style="text-align: center;">
                            @if($article->image_path)
                                <img src="{{ asset('storage/' . $article->image_path) }}" alt="{{ $article->title }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                            @else
                                <span style="color: #999; font-size: 12px;">Không có ảnh</span>
                            @endif
                        </td>
                        <td>{{ $article->title }}</td>
                        <td>{{ Str::limit($article->body, 50) }}</td>
                        <td>{{ $article->tags }}</td>
                        <td>{{ $article->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('articles.show', $article) }}" class="btn btn-secondary">Xem</a>
                            @auth
                                <a href="{{ route('articles.edit', $article) }}" class="btn btn-primary">Sửa</a>
                                @if(auth()->user()->is_admin)
                                    <form action="{{ route('articles.destroy', $article) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                    </form>
                                @endif
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Chưa có bài viết nào.</p>
    @endif
</body>
</html>