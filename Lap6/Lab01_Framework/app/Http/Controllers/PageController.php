<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        // Static content for the course introduction page
        $course = [
            'title' => 'Giới thiệu Khóa Học - Lập trình Web với Laravel',
            'objectives' => [
                'Hiểu cấu trúc MVC trong Laravel',
                'Sử dụng Blade template để xây dựng giao diện',
                'Làm việc với Eloquent ORM và migrations',
                'Tạo và xử lý form, validate dữ liệu',
                'Quản lý routes và controllers',
            ],
            'sessions' => [
                'Buổi 1: Tổng quan Laravel, cài đặt, hello world',
                'Buổi 2: Blade templates và layouts',
                'Buổi 3: Routes, controllers, request handling',
                'Buổi 4: Models, migrations, factories, seeding',
                'Buổi 5: Forms, validation, file upload',
                'Buổi 6: Eloquent relationships & querying',
                'Buổi 7: Tối ưu, deploy và best practices',
            ],
            'outcomes' => [
                'Viết ứng dụng web nhỏ sử dụng Laravel MVC',
                'Sử dụng Blade để tách layout và tái sử dụng view',
                'Thiết kế database với migrations và Eloquent',
                'Áp dụng validation và xử lý form an toàn',
            ],
        ];

        return view('pages.about', compact('course'));
    }
}
