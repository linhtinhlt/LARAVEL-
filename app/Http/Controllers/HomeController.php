<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Logic to retrieve all posts
        $posts = Post::orderBy('created_at', 'desc')->paginate(10); // Retrieve all posts, paginated
        $categories = Category::whereNull('parent_id')->with('children')->get();
        $breadcrumbs = [];

        // Other necessary logic (e.g., fetching categories, setting breadcrumbs)

        return view('home', compact('posts', 'categories', 'breadcrumbs'));

    }

}
