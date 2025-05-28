@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row">
        <!-- Tổng số bài viết -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-header">Bài viết</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $postCount ?? '0' }} bài viết</h5>
                    <p class="card-text">Tổng số bài viết được tạo trên hệ thống.</p>
                </div>
            </div>
        </div>

        <!-- Tổng số người dùng -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-header">Người dùng</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $userCount ?? '0' }} người dùng</h5>
                    <p class="card-text">Tổng số người dùng đã đăng ký.</p>
                </div>
            </div>
        </div>

        <!-- Tổng số danh mục -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3 shadow">
                <div class="card-header">Danh mục</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $categoryCount ?? '0' }} danh mục</h5>
                    <p class="card-text">Tổng số danh mục bài viết.</p>
                </div>
            </div>
        </div>
    </div>

   <div class="row">
    <div class="col-md-4">
        <ul class="list-group">
            <li class="list-group-item">
                <a class="text-dark" href="{{ route('users.index') }}">Xem tất cả tài khoản</a>
            </li>
            <li class="list-group-item">
                <a class="text-dark" href="{{ route('categories.create') }}">Tạo danh mục</a>
            </li>
            <li class="list-group-item">
                <a class="text-dark" href="{{ route('categories.index') }}">Sửa danh mục</a>
            </li>
            <li class="list-group-item">
                <a class="text-dark" href="{{ route('posts.mypost') }}">Bài viết của tôi</a>
            </li>
            <li class="list-group-item">
                <a class="text-dark" href="{{ route('posts.create') }}">Tạo bài viết</a>
            </li>
        </ul>
    </div>
</div>


</div>
@endsection
