@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tất cả danh mục</h1>

    @foreach($categories->where('parent_id', null) as $parent)
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>{{ $parent->name }}</strong>
                <div>
                    <a href="{{ route('categories.edit', $parent->id) }}" class="btn btn-sm btn-primary">Sửa</a>
                    <form action="{{ route('categories.destroy', $parent->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Bạn có chắc muốn xoá danh mục này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <h6>Bài viết</h6>
                <ul class="list-unstyled overflow-auto" style="max-height: 150px;">
                    @foreach($parent->posts as $post)
                        <li><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></li>
                    @endforeach
                </ul>

                @if($parent->children->count())
                    <h6 class="mt-3">Danh mục con</h6>
                    <ul class="list-group">
                        @foreach($parent->children as $child)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    {{ $child->name }}
                                    <div>
                                        <a href="{{ route('categories.edit', $child->id) }}" class="btn btn-sm btn-secondary">Sửa</a>
                                        <form action="{{ route('categories.destroy', $child->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Bạn có chắc muốn xoá danh mục con này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                        </form>
                                    </div>
                                </div>

                                <ul class="list-unstyled mt-2 ps-3">
                                    @foreach($child->posts as $post)
                                        <li><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
