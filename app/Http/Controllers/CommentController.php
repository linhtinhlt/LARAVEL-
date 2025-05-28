<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required',
        ]);

        $comment = new Comment($request->all());
        $comment->user_id = Auth::id();
        $comment->save();

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Bình luận thành công.');
    }
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        if (Auth::user()->id !== $comment->user_id && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Bạn không có quyền sửa bình luận này.');
        }
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['content' => 'required|string']);

        $comment = Comment::findOrFail($id);
        if (Auth::user()->id !== $comment->user_id && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Bạn không có quyền sửa bình luận này.');
        }

        $comment->update($request->only('content'));

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Sửa bình luận thành công.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if (Auth::user()->id !== $comment->user_id && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Bạn không có quyền xóa bình luận này.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Xoá bình luận thành công.');
    }
}
