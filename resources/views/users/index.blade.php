@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Quyền</th>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <td>
                            <div class="d-flex">
                                <form action="{{ route('users.change-role', $user->id) }}" method="POST" class="me-2">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning">
                                        {{ $user->role === 'admin' ? 'Xuống User' : 'Lên Admin' }}
                                    </button>
                                </form>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Bạn có chắc muốn xoá người dùng này')">Xoá</button>
                                </form>
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
