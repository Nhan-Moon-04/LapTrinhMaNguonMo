<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->get();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        // Dữ liệu hợp lệ đã được validate
        $data = $request->validated();
        
        // Debug: kiểm tra có file không
        if ($request->hasFile('image')) {
            // Lưu vào disk 'public' (đường dẫn: storage/app/public/articles/...)
            $path = $request->file('image')->store('articles', 'public');
            $data['image_path'] = $path; // lưu đường dẫn tương đối
            
            // Debug
            session()->flash('debug', 'Đã upload ảnh: ' . $path);
        } else {
            session()->flash('debug', 'Không có file upload');
        }
        
        // Tạo article mới
        Article::create($data);
        
        return redirect()->route('articles.index')
            ->with('success', 'Tạo bài viết thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        // Dữ liệu hợp lệ đã được validate
        $data = $request->validated();
        
        // Xử lý upload ảnh (nếu có)
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ (nếu có)
            if (!empty($article->image_path) && Storage::disk('public')->exists($article->image_path)) {
                Storage::disk('public')->delete($article->image_path);
            }
            
            // Lưu ảnh mới
            $data['image_path'] = $request->file('image')->store('articles', 'public');
        }
        
        // Cập nhật article
        $article->update($data);
        
        return redirect()->route('articles.show', $article)
            ->with('success', 'Cập nhật bài viết thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Xóa ảnh (nếu có)
        if (!empty($article->image_path) && Storage::disk('public')->exists($article->image_path)) {
            Storage::disk('public')->delete($article->image_path);
        }
        
        $article->delete();
        
        return redirect()->route('articles.index')
            ->with('success', 'Xóa bài viết thành công!');
    }
}
