<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .article-header {
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .article-title {
            font-size: 2em;
            margin-bottom: 10px;
        }
        .article-meta {
            color: #666;
            font-size: 14px;
        }
        .article-body {
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .article-tags {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 8px 12px;
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
    </style>
</head>
<body>
    <div class="article-header">
        <h1 class="article-title">{{ $article->title }}</h1>
        <div class="article-meta">
            Được tạo vào {{ $article->created_at->format('d/m/Y H:i') }}
            @if($article->created_at != $article->updated_at)
                | Cập nhật lần cuối: {{ $article->updated_at->format('d/m/Y H:i') }}
            @endif
        </div>
    </div>

    @if($article->image_path)
        <div class="article-image" style="margin-bottom: 20px; text-align: center;">
            <img src="{{ asset('storage/' . $article->image_path) }}" alt="{{ $article->title }}" style="max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 4px;">
        </div>
    @endif

    <div class="article-body">
        {!! nl2br(e($article->body)) !!}
    </div>

    @if($article->tags)
        <div class="article-tags">
            <strong>Tags:</strong> {{ $article->tags }}
        </div>
    @endif

    <div>
        <a href="{{ route('articles.edit', $article) }}" class="btn btn-primary">Chỉnh sửa</a>
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </div>
</body>
</html>