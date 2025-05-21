<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Course;
use App\Models\WishlistNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the wishlist items.
     */
    public function index()
    {
        $user = Auth::user();
        $wishlistItems = $user->wishlistCourses()->get();
        $notifications = WishlistNotification::where('user_id', $user->id)
            ->where('is_read', false)
            ->get();

        return view('user.themes.wishlist.wishlist', compact('user', 'wishlistItems', 'notifications'));
    }

    /**
     * Toggle course in wishlist (add if not exist, remove if exist)
     * Phương thức này hỗ trợ cả GET và POST
     */
    public function toggleWishlist(Request $request)
    {
        $user = Auth::user();
        $courseId = $request->course_id;

        // Nếu không có course_id trong request, thử lấy từ query parameter
        if (!$courseId && $request->has('id')) {
            $courseId = $request->id;
        }

        if (!$courseId) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Không tìm thấy khóa học'
                ], 400);
            }
            return back()->with('error', 'Không tìm thấy khóa học');
        }

        $existingWishlist = Wishlist::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->first();

        if ($existingWishlist) {
            // Đã có trong wishlist, xóa đi
            $existingWishlist->delete();

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'removed',
                    'message' => 'Khóa học đã được xóa khỏi danh sách yêu thích'
                ]);
            }

            return redirect()->back()->with('success', 'Khóa học đã được xóa khỏi danh sách yêu thích');
        } else {
            // Chưa có trong wishlist, thêm vào
            Wishlist::create([
                'user_id' => $user->id,
                'course_id' => $courseId
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'added',
                    'message' => 'Khóa học đã được thêm vào danh sách yêu thích'
                ]);
            }

            return redirect()->back()->with('success', 'Khóa học đã được thêm vào danh sách yêu thích');
        }
    }

    /**
     * Remove course from wishlist
     */
    public function removeFromWishlist($courseId)
    {
        $user = Auth::user();

        Wishlist::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->delete();

        return redirect()->route('user.wishlist.index')
            ->with('success', 'Khóa học đã được xóa khỏi danh sách yêu thích');
    }

    /**
     * Mark a notification as read
     */
    public function markNotificationAsRead($notificationId)
    {
        $notification = WishlistNotification::findOrFail($notificationId);
        $notification->update(['is_read' => true]);

        return response()->json([
            'status' => 'success',
            'message' => 'Thông báo đã được đánh dấu là đã đọc'
        ]);
    }
}