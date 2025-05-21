<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\CourseEnrolled;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $lessonId = $request->route('id');
        $lesson = \App\Models\Lesson::findOrFail($lessonId);
        
        // Kiểm tra xem user có đăng ký khóa học không
        $isEnrolled = CourseEnrolled::where('id_user', $user->id)
                                    ->where('id_course', $lesson->id_course)
                                    ->exists();

        if (!$isEnrolled) {
            return redirect()->route('user.index')->with('error', 'Bạn cần đăng ký khóa học để xem video này.');
        }

        return $next($request);
    }
}

?>