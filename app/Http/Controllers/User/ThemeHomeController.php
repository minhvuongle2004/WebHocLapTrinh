<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ThemeHomeController extends Controller
{
    public function course()
    {
        return view('user.themes.course.course');
    }

    public function indexuser()
    {
        $user = Auth::user();
        $suggestedCourses = collect(); // Danh sách khóa học gợi ý
        $randomCourses = collect(); // Danh sách khóa học ngẫu nhiên

        if ($user) {
            // Lấy danh sách category_id đã xem, sắp xếp theo view_count và last_viewed_at
            $viewedCategoryIds = DB::table('course_views')
                ->where('user_id', $user->id)
                ->orderByDesc('view_count')
                ->orderByDesc('last_viewed_at')
                ->pluck('category_id')
                ->unique()
                ->values();

            if ($viewedCategoryIds->isNotEmpty()) {
                // Lấy 4 khóa học gợi ý từ các category_id đã xem
                $suggestedCourses = Course::whereIn('category_id', $viewedCategoryIds)
                    ->inRandomOrder()
                    ->limit(4)
                    ->get();
            }

            // Nếu không đủ 4 khóa học gợi ý, bổ sung thêm khóa học ngẫu nhiên
            if ($suggestedCourses->count() < 4) {
                $excludeCourseIds = $suggestedCourses->pluck('id')->toArray();
                $additionalSuggested = Course::whereNotIn('id', $excludeCourseIds)
                    ->inRandomOrder()
                    ->limit(4 - $suggestedCourses->count())
                    ->get();
                $suggestedCourses = $suggestedCourses->merge($additionalSuggested);
            }

            // Lấy 12 khóa học ngẫu nhiên, loại trừ các khóa học đã gợi ý
            $excludeCourseIds = $suggestedCourses->pluck('id')->toArray();
            $randomCourses = Course::whereNotIn('id', $excludeCourseIds)
                ->inRandomOrder()
                ->limit(12)
                ->get();

            // Nếu không đủ 12 khóa học ngẫu nhiên, lấy thêm bất kỳ khóa học nào còn lại
            if ($randomCourses->count() < 88) {
                $remainingCourses = Course::whereNotIn('id', $excludeCourseIds)
                    ->inRandomOrder()
                    ->limit(12 - $randomCourses->count())
                    ->get();
                $randomCourses = $randomCourses->merge($remainingCourses);
            }
        } else {
            // Người dùng chưa đăng nhập: lấy 16 khóa học ngẫu nhiên
            $randomCourses = Course::inRandomOrder()->limit(12)->get();
        }

        // Kết hợp suggestedCourses và randomCourses thành recommendedCourses để tương thích với view hiện tại
        $recommendedCourses = $suggestedCourses->merge($randomCourses);
        $categories = Category::all();
        return view('user.index', compact('user', 'suggestedCourses', 'randomCourses', 'recommendedCourses', 'categories'));
    }

    public function course_enrolled()
    {
        $user = Auth::user();
        $coursesEnrolled = Auth::user()->enrolledCourses()->with('course.category')->get();

        return view('user.themes.course.enrolled-courses', compact('user', 'coursesEnrolled'));
    }

    public function showPersonal()
    {
        $user = Auth::user();

        return view('user.themes.personal.personal_page', compact('user'));
    }

    public function updatePersonal(Request $request)
    {
        $user = Auth::user();

        // Validate the input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'display_name' => ['required', 'string', 'in:full_name'],
            'new_password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'name.required' => 'Name is required',
            'new_password.min' => 'Password must be at least 8 characters long',
            'new_password.confirmed' => 'Passwords do not match',
        ]);

        // Update username
        $user->username = $validated['name'];

        // if ($validated['display_name'] === 'full_name') {
        //     $user->displayname = $validated['name'];
        // }

        // Update password if provided
        if ($request->filled('new_password')) {
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return redirect()->route('user.personal.show')
            ->with('success', 'Profile updated successfully!');
    }

    public function updateAvatar(Request $request)
    {
        try {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $user = Auth::user();

            // Xóa avatar cũ nếu có
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Lưu avatar mới
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
            $user->save();

            return response()->json([
                'success' => true,
                'avatar_url' => asset('storage/' . $avatarPath),
                'message' => 'Profile picture updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function login()
    {
        return view('user.themes.login.login');
    }

    public function filter($id)
    {
        if ($id == 'all') {
            $courses = Course::all();
        } else {
            $courses = Course::where('category_id', $id)->get();
        }

        return response()->json(['courses' => $courses])->header('Content-Type', 'application/json');
    }
}
