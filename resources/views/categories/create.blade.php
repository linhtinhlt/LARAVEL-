@extends('layouts.app')

@section('content')
<div class="w-100 d-flex ">
    <div class="d-flex flex-column w-50 ">
        <h1>Tạo danh mục</h1>
        <div>
            <div>
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <label for="name">Tên danh mục:</label>
                    <input type="text" name="name" required>

                    <label for="parent_id">Danh mục cha:</label>
                   <select name="parent_id" class="form-control">
                        <option value="">-- Không có danh mục cha --</option>
                        @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}"
                                {{ old('parent_id', $category->parent_id ?? null) == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit">Lưu</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

