<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    // Lấy danh sách review mới nhất
    public function getReviews($course_id)
    {
        $reviews = Review::with('user')
            ->where('id_course', $course_id)
            ->where('status', 'exist')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($reviews);
    }

    // Xử lý comment (chỉ người đã đăng ký khóa học mới được comment)
    public function store(Request $request, $course_id)
    {
        $user = Auth::user();

        // Check đã đăng ký khóa học chưa
        $isEnrolled = DB::table('tbl_payments')
            ->where('id_course', $course_id)
            ->where('id_user', $user->id)
            ->where('status', 'success')
            ->exists();


        if (!$isEnrolled) {
            return response()->json(['error' => 'Bạn cần đăng ký khóa học để comment'], 403);
        }

        // Lưu review
        $review = new Review();
        $review->id_user = $user->id;
        $review->id_course = $course_id;
        $review->content = $request->input('content');
        $review->rate = $request->input('rate', 5);
        $review->status = 'exist';
        $review->save();

        return response()->json([
            'success' => true,
            'review' => [
                'user' => $user->displayname,
                'content' => $review->content,
                'date' => $review->created_at->diffForHumans()
            ]
        ]);
    }
}
