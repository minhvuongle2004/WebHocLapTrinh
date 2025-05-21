<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessonController extends Controller
{
    // Hiển thị danh sách tất cả bài học
    public function index()
    {
        $lessons = Lesson::with('course')->get(); // ✅ Load luôn thông tin khóa học
        return view('admin.themes.lessons.tableLesson', compact('lessons'));
    }

    // Hiển thị chi tiết một bài học
    public function show($id)
    {
        $lesson = Lesson::with('course')->findOrFail($id); // ✅ Load luôn thông tin khóa học
        return view('admin.themes.lessons.lessonDetail', compact('lesson'));
    }

    // Hiển thị form tạo bài học mới
    public function create()
    {
        $courses = Course::all(); // ✅ Lấy danh sách khóa học
        return view('admin.themes.lessons.createLesson', compact('courses'));
    }

    // Lưu bài học mới vào database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'id_course' => 'required|exists:tbl_courses,id',
            'url' => 'required',
            'is_preview' => 'required|boolean',
            'time' => 'required|string|max:20|regex:/^[0-9:]+$/|regex:/^\d+:\d+$/',
            'chapter' => 'required|string|max:255'
        ]);

        try {
            // Tạo bài học mới
            Lesson::create($request->all());

            // Đếm số bài giảng có cùng id_course
            $lessonCount = Lesson::where('id_course', $request->id_course)->count();

            // Cập nhật tổng số bài giảng vào course tương ứng
            Course::where('id', $request->id_course)->update(['lesson' => $lessonCount]);

            return redirect()->route('admin.lessons.index')->with('success', 'Bài học đã được thêm thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    // Hiển thị form chỉnh sửa bài học
    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        $courses = Course::all(); // ✅ Lấy danh sách khóa học
        return view('admin.themes.lessons.editLesson', compact('lesson', 'courses'));
    }

    // Cập nhật thông tin bài học
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'id_course' => 'required|exists:tbl_courses,id',
            'url' => 'required',
            'is_preview' => 'required|boolean',
            'time' => 'required|string|max:20|regex:/^[0-9:]+$/|regex:/^\d+:\d+$/',
            'chapter' => 'required|string|max:255'
        ]);

        try {
            $lesson = Lesson::findOrFail($id);
            $lesson->update($request->all());
            $lessonCount = Lesson::where('id_course', $request->id_course)->count();
            Course::where('id', $request->id_course)->update(['lesson' => $lessonCount]);
            return redirect()->route('admin.lessons.index')->with('success', 'Thông tin bài học đã được cập nhật');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    // Xóa một bài học
    public function destroy($id)
    {
        try {
            $lesson = Lesson::findOrFail($id);
            $lesson->delete();
            return redirect()->route('admin.lessons.index')->with('success', 'Bài học này đã được xoá');
        } catch (\Exception $e) {
            return back()->with('error', 'Không thể xóa bài học: ' . $e->getMessage());
        }
    }
}
