@extends('layouts.app')


@section('content')
<div class="container mt-4">

    <div class="row">
       

        <!-- BÀI VIẾT -->
        <section class="col">
            <h3 class="mb-4 border-bottom pb-2">TIN NỔI BẬT</h3>

            @if($posts->count() > 0)
                {{-- Bài viết nổi bật đầu tiên --}}
                @php $featured = $posts->first(); @endphp
                <div class="card mb-4 shadow-sm border-0">
                    <div class="row g-0">
                        <div class="col-md-5">
                            @php $isUrl = filter_var($featured->image, FILTER_VALIDATE_URL); @endphp
                            <img src="{{ $isUrl ? $featured->image : asset('images/' . $featured->image) }}"
                                 class="img-fluid h-100 w-100 rounded-start object-fit-cover"
                                 style="max-height: 400px;" alt="{{ $featured->title }}">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{ route('posts.show', $featured->id) }}" class="text-decoration-none text-dark">
                                        {{ $featured->title }}
                                    </a>
                                </h4>
                                <p class="text-muted mb-2">Tác giả: {{ $featured->user->name }}</p>
                                <p class="card-text">
                                    {{ \Illuminate\Support\Str::words(strip_tags($featured->content), 50, '...') }}
                                </p>
                                <a href="{{ route('posts.show', $featured->id) }}" class="btn btn-sm btn-outline-primary">Xem thêm</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Ba bài tiếp theo hiển thị nhỏ --}}
                <div class="row">
                    @foreach($posts->skip(1)->take(3) as $post)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                @php $isUrl = filter_var($post->image, FILTER_VALIDATE_URL); @endphp
                                <img src="{{ $isUrl ? $post->image : asset('images/' . $post->image) }}"
                                     class="card-img-top object-fit-cover" style="height: 400px;" alt="{{ $post->title }}">
                                <div class="card-body">
                                    <h6 class="card-title fw-semibold">
                                        <a href="{{ route('posts.show', $post->id) }}" class="text-dark text-decoration-none">
                                            {{ \Illuminate\Support\Str::limit($post->title, 50) }}
                                        </a>
                                    </h6>
                                    <p class="text-muted" style="font-size: 0.85rem;">{{ $post->user->name }}</p>
                                    <p class="card-text" style="font-size: 0.9rem;">
                                        {{ \Illuminate\Support\Str::words(strip_tags($post->content), 20, '...') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Các bài còn lại --}}
                @php
                    $morePosts = $posts->skip(4);
                @endphp

                @if($morePosts->count())
                    <h4 class="mt-5 mb-4 border-bottom pb-2">ĐÁNG CHÚ Ý</h4>
                    <div class="row">
                        @foreach($morePosts as $post)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 shadow-sm border-0">
                                    @php $isUrl = filter_var($post->image, FILTER_VALIDATE_URL); @endphp
                                    <img src="{{ $isUrl ? $post->image : asset('images/' . $post->image) }}"
                                         class="card-img-top object-fit-cover" style="height: 400px;" alt="{{ $post->title }}">
                                    <div class="card-body">
                                        <h6 class="card-title fw-semibold">
                                            <a href="{{ route('posts.show', $post->id) }}" class="text-dark text-decoration-none">
                                                {{ \Illuminate\Support\Str::limit($post->title, 60) }}
                                            </a>
                                        </h6>
                                        <p class="text-muted" style="font-size: 0.85rem;">{{ $post->user->name }}</p>
                                        <p class="card-text" style="font-size: 0.9rem;">
                                            {{ \Illuminate\Support\Str::words(strip_tags($post->content), 25, '...') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            @endif

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                {{ $posts->links('pagination::bootstrap-5') }}
            </nav>
        </section>
    </div>
</div>
@endsection