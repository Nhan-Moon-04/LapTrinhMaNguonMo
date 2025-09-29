@extends('layouts.app')

@section('title', 'Giới thiệu Khóa Học')

@section('content')
    <x-card :title="$course['title']">
        <section>
            <h3>Mục tiêu học phần</h3>
            <ul>
                @foreach ($course['objectives'] as $obj)
                    <li>{{ $obj }}</li>
                @endforeach
            </ul>
        </section>

        <section>
            <h3>Lịch 7 buổi lab</h3>
            <ol>
                @foreach ($course['sessions'] as $s)
                    <li>{{ $s }}</li>
                @endforeach
            </ol>
        </section>

        <section>
            <h3>Chuẩn đầu ra mong đợi</h3>
            <ul>
                @foreach ($course['outcomes'] as $o)
                    <li>{{ $o }}</li>
                @endforeach
            </ul>
        </section>
    </x-card>

@endsection