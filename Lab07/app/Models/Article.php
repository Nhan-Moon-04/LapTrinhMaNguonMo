<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Article extends Model
{
    // Mock dữ liệu
    private static $dataset = [
        1 => ['id' => 1, 'title' => 'Giới thiệu Laravel', 'body' => 'Nội dung demo A'],
        2 => ['id' => 2, 'title' => 'Blade nâng cao', 'body' => 'Nội dung demo B'],
    ];

    // override resolveRouteBinding để giả lập findOrFail
    public function resolveRouteBinding($value, $field = null)
    {
        if (isset(self::$dataset[$value])) {
            $article = new self();
            $article->fill(self::$dataset[$value]);
            return $article;
        }

        throw (new ModelNotFoundException)->setModel(self::class, $value);
    }

    protected $fillable = ['id', 'title', 'body'];
}
