<?php

namespace App\Http\Controllers\Admin;

use App\Models\CourseEnrolled;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseEnrolledController extends Controller
{
    public function index()
    {
        $enrollments = CourseEnrolled::with(['user', 'course'])->get();
        return view('admin.themes.course_enrolled.tableEnrolled', compact('enrollments'));
    }

    public function show($id)
    {
        $enrollment = CourseEnrolled::with(['user', 'course'])->findOrFail($id);
        return view('admin.themes.course_enrolled.detailEnrolled', compact('enrollment'));
    }

    public function create()
    {
        $users = User::all();
        $courses = Course::all();
        return view('admin.themes.course_enrolled.createEnrolled', compact('users', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:tbl_users,id',
            'id_course' => 'required|exists:tbl_courses,id',
            'title_course' => 'required|string',
            'status' => 'required|in:completed,in_progess,expired',
            'progess' => 'required|numeric|min:0|max:100',
            'expiration_date' => 'required|date',
        ]);

        CourseEnrolled::create($request->all());
        return redirect()->route('admin.courseEnrolled.index')->with('success', 'Đăng ký khóa học đã được thêm thành công');
    }

    public function edit($id)
    {
        $enrollment = CourseEnrolled::findOrFail($id);
        $users = User::all();
        $courses = Course::all();
        return view('admin.themes.course_enrolled.editEnrolled', compact('enrollment', 'users', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:tbl_users,id',
            'id_course' => 'required|exists:tbl_courses,id',
            'title_course' => 'required|string',
            'status' => 'required|in:completed,in_progess,expired',
            'progess' => 'required|numeric|min:0|max:100',
            'expiration_date' => 'required|date',
        ]);

        $enrollment = CourseEnrolled::findOrFail($id);
        $enrollment->update($request->all());
        return redirect()->route('admin.courseEnrolled.index')->with('success', 'Đăng ký khóa học đã được cập nhật');
    }

    public function destroy($id)
    {
        CourseEnrolled::findOrFail($id)->delete();
        return redirect()->route('admin.courseEnrolled.index')->with('success', 'Đăng ký khóa học đã được xóa');
    }
}
