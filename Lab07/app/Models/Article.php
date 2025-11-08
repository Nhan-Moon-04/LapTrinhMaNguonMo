<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article
{
    public $id;
    public $title;

    public $noidung;

    public function __construct($id, $title, $noidung)
    {
        $this->id = $id;
        $this->title = $title;
        $this->noidung = $noidung;
    }

    // Lấy tất cả bài viết (mock)
    public static function all()
    {
        return [
            1 => new Article(1, 'Laravel 12', 'Sản phẩm ncc'),
            2 => new Article(2, 'Blade Components', 'aaaaaaaaaaaaaaaaaa'),
            3 => new Article(3, 'Route Model Binding', 'aaaaaaaaaaaaaaa'),
        ];
    }


   // Tìm 1 bài viết
    public static function findOrFail($id)
    {
         $id = (int) $id; 
         
        $articles = self::all();

        if (isset($articles[$id])) {
            return $articles[$id];
        }

        abort(404, 'Article not found');
    }

    // Giả lập xoá (ở đây chỉ cần kiểm tra tồn tại)
    public static function delete($id)
    {
        $articles = self::all();
        if (! isset($articles[$id])) {
            abort(404, 'Article not found');
        }

        // Demo: sau này xoá DB, giờ return true
        return true;
    }
}
