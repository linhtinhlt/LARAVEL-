@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Tạo bài viết mới</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Nội dung:</label>
            <textarea name="content" id="content" rows="6" class="form-control" required>{{ old('content') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục:</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
    <label for="image" class="form-label">Ảnh bài viết (không bắt buộc):</label>
    <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImageFromFile(event)">
    <img id="image-preview" src="#" alt="Ảnh xem trước" class="img-thumbnail mt-2" style="max-width: 200px; display: none;">
</div>

<div class="mb-3">
    <label for="image_url" class="form-label">Hoặc nhập URL ảnh:</label>
    <input type="url" name="image_url" id="image_url" class="form-control" placeholder="https://example.com/image.jpg" oninput="previewImageFromUrl(this.value)">
</div>

<script>
function previewImageFromFile(event) {
    const input = event.target;
    const preview = document.getElementById('image-preview');
    const imageUrlInput = document.getElementById('image_url');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);

        // Clear URL input if user selects file
        imageUrlInput.value = '';
    }
}

function previewImageFromUrl(url) {
    const preview = document.getElementById('image-preview');
    const fileInput = document.getElementById('image');

    if(url.trim() === '') {
        preview.style.display = 'none';
        preview.src = '#';
        return;
    }

    preview.src = url;
    preview.style.display = 'block';

    // Clear file input if user types URL
    fileInput.value = '';
}
</script>


        <button type="submit" class="btn btn-primary">Tạo bài viết</button>
    </form>
</div>

<script>
    function previewImage(event) {
        let input = event.target;
        let preview = document.getElementById('image-preview');
        if(input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
</script>
@endsection
