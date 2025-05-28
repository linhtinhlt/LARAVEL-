@extends('layouts.app')

@section('content')
<div class="container">


    <h1 class="mt-4 mb-3">Bài viết của tôi</h1>

    <!-- Danh sách bài đăng của người dùng đã đăng nhập -->
    <ul class="d-flex list-unstyled flex-wrap">
        @foreach($posts as $post)
            <li class="border-bottom mb-3 pb-3">
                <div class="row">
                    <div class="col-sm-4 grid-margin">
                        <div class="position-relative">
                            <div class="rotate-img">
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

                            </div>
                            <div class="badge-positioned">
                                <span class="badge badge-danger font-weight-bold">Flash news</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 grid-margin">
                        <h2 class="mb-2 font-weight-600">
                            <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                        </h2>
                        <div class="fs-13 mb-2">
                            <span class="mr-2">Tác giả: </span>{{ $post->user->name }}
                        </div>
                        <p class="mb-0">
                            {{ \Illuminate\Support\Str::words(strip_tags($post->content), 40, '...') }}
                            <a class="text-info" href="{{ route('posts.show', $post->id) }}">Xem thêm</a>
                        </p>
                        <!-- Actions (Edit/Delete) for authenticated users -->
                        @if(Auth::check() && (Auth::id() === $post->user_id || Auth::user()->role === 'admin'))
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


    <!-- Hiển thị phân trang -->
    <div>
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection