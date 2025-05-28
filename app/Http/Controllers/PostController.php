<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        // Cho phép xem bài viết, danh sách không cần đăng nhập
        $this->middleware('auth')->except(['index', 'show', 'allPosts']);
    }

    // Hiển thị danh sách bài viết (có thể lọc)
    public function index(Request $request)
    {
        $query = Post::query();

        if ($categoryId = $request->query('category')) {
            $query->where('category_id', $categoryId);
        }

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if ($request->filled('author')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('author') . '%');
            });
        }

        $query->orderBy('created_at', 'desc');

        $posts = $query->paginate(10);
        $categories = Category::limit(5)->get();

        return view('posts.index', compact('posts', 'categories'));
    }

    // Hiển thị trang tạo bài viết
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    // Lưu bài viết mới
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image_url' => 'nullable|url',
    ]);

    $data = $request->only(['title', 'content', 'category_id']);

    // Xử lý hình ảnh
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $data['image'] = $imageName;
    } elseif (!empty($request->image_url)) {
        $data['image'] = $request->image_url;
    } else {
        $data['image'] = null;
    }

    // Gán user_id cho bài viết
    $data['user_id'] = Auth::id(); // Lấy id user đang đăng nhập

    Post::create($data);

    return redirect()->route('posts.index')->with('success', 'Bài viết đã được tạo thành công!');
}

    // Hiển thị chi tiết bài viết
    public function show(Post $post)
    {
        $post->load('comments.user');
        $category = $post->category;

        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->take(10)
            ->get();

        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => $category->name, 'url' => route('posts.index', ['category' => $category->id])],
            ['name' => $post->title, 'url' => ''],
        ];

        return view('posts.show', compact('post', 'breadcrumbs', 'relatedPosts'));
    }

    // Danh sách bài viết của user đang đăng nhập, có lọc
    public function mypost(Request $request)
    {
        $query = Post::where('user_id', Auth::id());

        if ($categoryId = $request->query('category')) {
            $query->where('category_id', $categoryId);
        }

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        $query->orderBy('created_at', 'desc');

        $posts = $query->paginate(10);
        $categories = Category::limit(5)->get();

        return view('posts.mypost', compact('posts', 'categories'));
    }

    // Hiển thị form chỉnh sửa bài viết
    public function edit(Post $post)
    {
        // Phân quyền: chỉ admin hoặc owner mới được sửa
        if (Auth::id() !== $post->user_id && Auth::user()->role !== 'admin') {
            return redirect()->route('posts.index')->with('error', 'Bạn không có quyền thực hiện hành động này.');
        }

        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    // Cập nhật bài viết
    public function update(Request $request, Post $post)
    {
        if (Auth::id() !== $post->user_id && Auth::user()->role !== 'admin') {
            return redirect()->route('posts.index')->with('error', 'Bạn không có quyền thực hiện hành động này.');
        }

        $request->validate([
            'title'       => 'required',
            'content'     => 'required',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'category_id']);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $post->update($data);

        return redirect()->route('posts.show', $post->id)->with('success', 'Cập nhật bài viết thành công.');
    }

    // Xóa bài viết
    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id && Auth::user()->role !== 'admin') {
            return redirect()->route('posts.index')->with('error', 'Bạn không có quyền thực hiện hành động này.');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Xóa bài viết thành công.');
    }

    // Hiển thị tất cả bài viết, không giới hạn
    public function allPosts(Request $request)
    {
        $posts = Post::paginate(10);
        $categories = Category::all();
        $breadcrumbs = [];

        return view('posts.all', compact('posts', 'categories', 'breadcrumbs'));
    }
}
