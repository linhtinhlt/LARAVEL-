<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myAccount()
    {
        $user = Auth::user(); // Lấy thông tin của người dùng hiện tại

        return view('users.my-account', compact('user'));
    }
    public function index()
    {
        // Lấy danh sách người dùng
        if (Auth::user()->role === 'admin') {
            // Nếu là admin, lấy tất cả người dùng
            $users = User::all();
        } else {
            // Nếu không phải admin, lấy thông tin của người dùng hiện tại (không bao gồm admin)
            $users = User::where('id', '!=', Auth::id())->get();
        }

        return view('users.index', compact('users'));
    }



    public function destroy(User $user)
    {
        // Kiểm tra xem người dùng hiện tại có quyền xóa người dùng không
        if (Auth::user()->role === 'admin') {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Xoá người dùng thành công.');
        } else {
            return redirect()->route('users.index')->with('error', 'Bạn không có quyền xóa người dùng này.');
        }
    }
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validation rules can be added here

        // Update user details based on the request data
        $user->update($request->all());

        // Redirect back to the user's profile page
        return redirect()->route('users.myAccount', compact('user'));
    }
    public function changeRole(User $user)
    {
        if (Auth::user()->role === 'admin') {
            $user->role = $user->role === 'admin' ? 'user' : 'admin';
            $user->save();

            return redirect()->route('users.index')->with('success', 'Cập nhập quyền người dùng thành công.');
        }

        return redirect()->route('users.index')->with('error', 'Bạn không có quyền chỉnh sửa quyền người dùng này.');
    }
}
