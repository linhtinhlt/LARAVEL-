<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
      public function index()
    {
        $categories = Category::with(['posts' => function ($query) {
            $query->take(3); 
        }])->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        // Chỉ lấy danh mục cha (parent_id = null)
        $parentCategories = Category::whereNull('parent_id')->get();
        return view('categories.create', compact('parentCategories'));
    }

 public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|unique:categories|max:255',
        'parent_id' => 'nullable|exists:categories,id',
    ]);

    // Ép '' thành null nếu không chọn danh mục cha
    if ($request->input('parent_id') === '') {
        $validated['parent_id'] = null;
    }

    Category::create($validated);

    return redirect()->route('categories.index')->with('success', 'Tạo danh mục thành công.');
}

public function update(Request $request, Category $category)
{
    $validated = $request->validate([
        'name' => 'required|max:255|unique:categories,name,' . $category->id,
        'parent_id' => 'nullable|exists:categories,id|not_in:' . $category->id,
    ]);

    if ($request->input('parent_id') === '') {
        $validated['parent_id'] = null;
    }

    $category->update($validated);

    return redirect()->route('categories.index')->with('success', 'Danh mục cập nhật thành công.');
}

    public function edit(Category $category)
    {
        // Không cho chọn chính nó làm cha
        $parentCategories = Category::whereNull('parent_id')
                                    ->where('id', '!=', $category->id)
                                    ->get();

        return view('categories.edit', compact('category', 'parentCategories'));
    }

    public function destroy(Category $category): RedirectResponse
    {
        // Nếu có danh mục con thì không cho xoá
        if ($category->children()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Không thể xoá danh mục có danh mục con.');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Xoá danh mục thành công.');
    }
}
