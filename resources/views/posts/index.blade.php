@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-between">

    <div class="w-85">

        <h1>Tất cả tin tức</h1>
        <div class="d-flex align-items-center">    
            <h2 class="me-2">Danh mục:</h2>
            <div class="dropdown">
                <button class="pb-0 border-0 text-dark btn btn-secondary dropdown-toggle bg-transparent" type="button" id="categoryDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{ request()->query('category') ? $categories->firstWhere('id', request()->query('category'))->name : 'All Categories' }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                    <li><a class="dropdown-item" href="{{ route('posts.index') }}">Tất cả</a></li>
                    @foreach($categories as $category)
                        <li><a class="dropdown-item text-dark"
                                href="{{ route('posts.index', ['category' => $category->id]) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <hr>

        <!-- Danh sách bài đăng đã lọc -->
        <ul class="d-flex list-unstyled flex-wrap">
            @foreach($posts as $post)
                <li class="">
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
    </div>
    <div class="w-15">
        <div class=" d-flex ps-3 justify-content-start flex-column">
            <h3 class="py-3">Danh mục </h3>
            <ul class="nav flex-column">
                @foreach($categories as $category)
                    <li class="nav-item"><a class="nav-link text-dark"
                            href="{{ route('posts.index', ['category' => $category->id]) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Hiển thị phân trang -->

</div>
<div class="">
    {{ $posts->links('pagination::bootstrap-5') }}
</div>
@endsection