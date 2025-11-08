<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Student;

class ReportController extends Controller
{
    public function index()
    {
        // 1) All products with price > 100000
        $expensiveProducts = Product::query()
            ->where('price', '>', 100000)
            ->orderByDesc('price')
            ->get();

        // 2) Count number of products per category (withCount)
        $categoriesWithCounts = Category::query()
            ->withCount('products')
            ->orderBy('name')
            ->get();

        // 3) Students with number of registered courses
        $studentsWithCourseCounts = Student::query()
            ->withCount('courses')
            ->orderBy('name')
            ->get();

        return view('reports.index', compact(
            'expensiveProducts',
            'categoriesWithCounts',
            'studentsWithCourseCounts'
        ));
    }
}
