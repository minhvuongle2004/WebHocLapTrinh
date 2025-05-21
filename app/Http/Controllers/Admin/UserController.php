<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    // Hiển thị danh sách tất cả người dùng
    public function index()
    {
        $users = User::all();
        return view('admin.themes.users.tableUser', compact('users'));
    }

    // Hiển thị chi tiết một người dùng
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.themes.users.userDetail', compact('user'));
    }

    // Hiển thị form tạo người dùng mới
    public function create()
    {
        return view('admin.themes.users.createUser');
    }

    // Lưu người dùng mới vào database
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:200',
            'displayname' => 'required|string|max:150',
            'username' => 'required|string|max:200|unique:tbl_users,username',
            'email' => 'required|string|email|max:200|unique:tbl_users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|regex:/^0\d{9}$/|size:10',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('password');
        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }

        $user = User::create($data);

        if ($user) {
            return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được thêm thành công');
        } else {
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }


    // Hiển thị form chỉnh sửa người dùng
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.themes.users.editUser', compact('user'));
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, $id)
    {

        $request->validate([
            'fullname' => 'required|string|max:200',
            'displayname' => 'required|string|max:150',
            'username' => 'required|string|max:200|unique:tbl_users,username,' . $id,
            'email' => 'required|string|email|max:200|unique:tbl_users,email,' . $id,
            'phone' => 'nullable|string|regex:/^0\d{9}$/|size:10',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);

        $data = $request->except(['password', 'avatar']);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Thông tin người dùng đã được cập nhật');
    }

    // Xóa một người dùng
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được xóa');
    }
}