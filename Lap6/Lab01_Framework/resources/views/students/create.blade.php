@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl mb-4">Tạo sinh viên mới</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 mb-4">{{ session('success') }}</div>
        @endif

        <form action="{{ route('students.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block">Họ và tên</label>
                <input type="text" name="name" value="{{ old('name') }}" class="border p-2 w-full" />
                @error('name')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="border p-2 w-full" />
                @error('email')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block">Tuổi</label>
                <input type="number" name="age" value="{{ old('age') }}" class="border p-2 w-full" />
                @error('age')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block">Giới tính</label>
                <select name="gender" class="border p-2 w-full">
                    <option value="" {{ old('gender') == '' ? 'selected' : '' }}>-- chọn --</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button class="bg-blue-600 text-white px-4 py-2">Tạo</button>
                <a href="/students/db" class="ml-2 text-gray-600">Hủy</a>
            </div>
        </form>
    </div>
@endsection