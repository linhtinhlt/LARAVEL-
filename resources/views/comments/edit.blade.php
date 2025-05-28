@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa</h1>
    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="content">Bình luận:</label>
            <textarea name="content" id="content" class="form-control" rows="4" required>{{ $comment->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Cập nhập</button>
    </form>
</div>
@endsection
