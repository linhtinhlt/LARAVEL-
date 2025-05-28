@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center flex-column">
    <div class="w-50">
        <h1>Đăng nhập</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="w-75">
                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                </div>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="w-75">
                <div>
                    <label for="password">Mật khẩu:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="w-75 d-flex justify-content-center align-items-center">
                <button type="submit">Đăng nhập</button>
                <div class="nav-item ms-3">
                    <a class="text-dark" href="{{ route('register') }}">Đăng ký</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
