<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // Hiển thị danh sách tất cả danh mục
    public function index()
    {
        $categories = Category::all();
        return view('admin.themes.categories.tableCategory', compact('categories'));
    }

    // Hiển thị chi tiết một danh mục
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.themes.categories.categoryDetail', compact('category'));
    }

    // Hiển thị form tạo danh mục mới
    public function create()
    {
        return view('admin.themes.categories.createCategory');
    }

    // Lưu danh mục mới vào database
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:tbl_categories,category_name',
        ]);

        $category = Category::create([
            'category_name' => $request->category_name,
        ]);

        if ($category) {
            return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được thêm thành công');
        } else {
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    // Hiển thị form chỉnh sửa danh mục
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.themes.categories.editCategory', compact('category'));
    }

    // Cập nhật thông tin danh mục
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:tbl_categories,category_name,' . $id,
        ]);

        $category = Category::find($id);

        if (!$category) {
            return back()->with('error', 'Danh mục không tồn tại!');
        }

        $category->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Thông tin danh mục đã được cập nhật');
    }

    // Xóa một danh mục
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Danh mục này đã được xoá');
    }
}
