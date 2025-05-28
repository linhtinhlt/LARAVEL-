<!-- resources/views/categories/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh mục: {{ $category->name }}</h1>

    <ul class="d-flex list-unstyled flex-wrap">
        @foreach($posts as $post)
            <li class="border-bottom mb-3 pb-3 w-100">
                <div class="row">
                    <div class="col-sm-12 grid-margin">
                        <h2 class="mb-2 font-weight-600">
                            <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                        </h2>
                        <div class="fs-13 mb-2">
                            <span class="mr-2">Tác giả: </span>{{ $post->user->name }}
                        </div>
                        <p class="mb-0">
                            {{ \Illuminate\Support\Str::words(strip_tags($post->content), 40, '...') }}
                            <a href="{{ route('posts.show', $post->id) }}">Xem thêm</a>
                        </p>
                        <!-- Actions (Edit/Delete) for authenticated users -->
                        @if(Auth::check() && (Auth::id() === $post->user_id || Auth::user()->is_admin))
                            <div class="actions mt-2 d-flex align-items-center">
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary me-2">Sửa</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this post?')">Xoá</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    <div class="mt-3">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
