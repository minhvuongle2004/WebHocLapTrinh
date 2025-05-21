<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    // Hiển thị danh sách tất cả admin
    public function index()
    {
        $admins = Admin::all();
        return view('admin.themes.admins.tableAdmin', compact('admins'));
    }

    // Hiển thị chi tiết một admin
    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.themes.admins.detailAdmin', compact('admin'));
    }

    // Hiển thị form tạo admin mới
    public function create()
    {
        return view('admin.themes.admins.createAdmin');
    }

    // Lưu admin mới vào database
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100|unique:tbl_admins,username',
            'password' => 'required|string|min:6',
        ]);

        $data = [
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ];

        $admin = Admin::create($data);

        if ($admin) {
            return redirect()->route('admin.admins.index')->with('success', 'Admin đã được thêm thành công');
        } else {
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    // Hiển thị form chỉnh sửa admin
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.themes.admins.editAdmin', compact('admin'));
    }

    // Cập nhật thông tin admin
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:100|unique:tbl_admins,username,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $admin = Admin::findOrFail($id);

        $data = ['username' => $request->username];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.admins.index')->with('success', 'Thông tin admin đã được cập nhật');
    }

    // Xóa một admin
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect()->route('admin.admins.index')->with('success', 'Admin đã được xóa');
    }
}