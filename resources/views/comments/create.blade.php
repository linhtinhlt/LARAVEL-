@extends('layouts.app')

@section('content')
<div >
    <h1>Bình luận:</h1>
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <div>
            <label for="post_id">Bài viết:</label>
            <select name="post_id" id="post_id" required>
                @foreach($posts as $post)
                    <option value="{{ $post->id }}">{{ $post->title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="content">Nội dung:</label>
            <textarea name="content" id="content" required></textarea>
        </div>
        <button type="submit">Bình luận</button>
    </form>
</div>
@endsection
