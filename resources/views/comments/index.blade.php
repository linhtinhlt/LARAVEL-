@extends('layouts.app')

@section('content')
<div >
    <h1>Bình luận</h1>
    <ul>
        @foreach($comments as $comment)
            <li>{{ $comment->content }} Bởi {{ $comment->user->name }} Trong <a href="{{ route('posts.show', $comment->post->id) }}">{{ $comment->post->title }}</a></li>
        @endforeach
    </ul>
</div>
@endsection
