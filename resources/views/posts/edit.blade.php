@extends('layouts.app')

@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">

        <div class="border-right w-100">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Chỉnh sửa bài viết</h4>
                </div>
                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Tên:</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Nội dung:</label>
                        <textarea name="content" id="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Danh mục:</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Input upload file -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload ảnh (nếu muốn):</label>
                        <input type="file" name="image" id="image" class="form-control-file" onchange="previewImage(event)">
                    </div>

                    <!-- Input URL ảnh -->
                    <div class="mb-3">
                        <label for="image_url" class="form-label">Hoặc nhập URL ảnh:</label>
                        <input type="url" name="image_url" id="image_url" class="form-control" value="{{ old('image_url', (filter_var($post->image, FILTER_VALIDATE_URL) ? $post->image : '')) }}" oninput="previewImageUrl(this.value)">
                    </div>

                    <!-- Preview ảnh -->
                    <div class="mb-3">
                        <label class="form-label">Ảnh xem trước:</label><br>
                        <img id="image-preview" 
                            src="@if(filter_var($post->image, FILTER_VALIDATE_URL)){{ $post->image }}@else{{ asset('images/' . $post->image) }}@endif" 
                            alt="Ảnh bài viết" 
                            class="img-thumbnail" 
                            style="max-width: 200px;">
                    </div>

                    <div class="text-start">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>

                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <div class="text-start">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xoá bài viết này?')">Xoá</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    function previewImage(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var output = document.getElementById('image-preview');
                output.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);

            // Khi chọn file, xóa giá trị URL để tránh nhầm lẫn
            document.getElementById('image_url').value = '';
        }
    }

    function previewImageUrl(url) {
        if (url) {
            var output = document.getElementById('image-preview');
            output.src = url;

            // Khi nhập URL, xóa file upload để tránh nhầm lẫn
            document.getElementById('image').value = '';
        }
    }
</script>
@endsection
