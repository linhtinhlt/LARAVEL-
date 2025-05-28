@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @include('partials.breadcrumb')
            <div class="post-content">
                <h1 class="post-title">{{ $post->title }}</h1>

                @if ($post->image)
                @php
                    $isUrl = filter_var($post->image, FILTER_VALIDATE_URL);
                @endphp

                @if ($isUrl)
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid" />
                @else
                    <img src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid" />
                @endif
            @endif


                <div class="post-info mb-4">
                    <p><strong>Tác giả:</strong> {{ $post->user->name }}</p>
                    <p><strong>Danh Mục:</strong> {{ $post->category->name }}</p>
                    <div>{!! nl2br(e($post->content)) !!}</div>
                </div>
            </div>

            <div class="comments-section my-4">
                <h2>Bình luận:</h2>
                <ul class="list-group">
                    @foreach($post->comments as $comment)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p>{{ $comment->content }} <br>
                                    <small><strong>Bởi {{ $comment->user->name }}</strong></small></p>
                                </div>
                                @if(Auth::check() && (Auth::user()->id == $comment->user_id || Auth::user()->role === 'admin'))
                                    <div class="btn-group">
                                        <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-primary me-1">Sửa</a>
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc xoá bình luận này không?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            @auth
                <div class="form-container my-4">
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="form-group">
                            <label for="content" class="form-label">Nội dung:</label>
                            <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Thêm bình luận</button>
                    </form>
                </div>
            @endauth
        </div>

        <div class="col-md-4">
            <div class="sidebar">
                <h3>Bài viết liên quan</h3>
                <ul class="list-group">
                    @foreach($relatedPosts as $relatedPost)
                        <li class="list-group-item d-flex align-items-center">
                            @if($relatedPost->image)
                                @php
                                    $isUrl = filter_var($relatedPost->image, FILTER_VALIDATE_URL);
                                @endphp
                                @if($isUrl)
                                    <img src="{{ $relatedPost->image }}" alt="Related Post Image" class="img-thumbnail me-2" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/' . $relatedPost->image) }}" alt="Related Post Image" class="img-thumbnail me-2" style="width: 60px; height: 60px; object-fit: cover;">
                                @endif
                            @endif
                            <a href="{{ route('posts.show', $relatedPost->id) }}">{{ $relatedPost->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
