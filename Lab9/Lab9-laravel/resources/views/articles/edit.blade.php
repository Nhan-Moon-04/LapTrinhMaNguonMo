<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa bài viết</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px;
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
        .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn:hover {
            opacity: 0.8;
        }
        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <h1>Chỉnh sửa bài viết</h1>

    <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}">
            @error('title')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="body">Nội dung</label>
            <textarea id="body" name="body">{{ old('body', $article->body) }}</textarea>
            @error('body')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tags">Tags (tùy chọn)</label>
            <input type="text" id="tags" name="tags" value="{{ old('tags', $article->tags) }}" placeholder="Ví dụ: laravel, php, web development">
            @error('tags')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Ảnh minh họa (tùy chọn)</label>
            @if($article->image_path)
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/' . $article->image_path) }}" alt="Ảnh hiện tại" style="max-width: 200px; height: auto; border: 1px solid #ddd; border-radius: 4px;">
                    <p style="font-size: 12px; color: #666;">Ảnh hiện tại</p>
                </div>
            @endif
            <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png">
            @error('image')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row">
            <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
            <a href="{{ route('articles.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
</body>
</html>