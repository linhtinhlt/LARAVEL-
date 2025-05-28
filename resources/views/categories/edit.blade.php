@extends('layouts.app')

@section('content')
<div class="w-100 d-flex">
    <div class="d-flex flex-column w-50">
        <h1>Sửa danh mục</h1>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                Tên: <input type="text" name="name" id="name" value="{{ $category->name }}" required>
            </div>
            <button type="submit">Chỉnh sửa</button>
        </form>
    </div>

</div>
@endsection