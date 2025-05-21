<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\CourseEnrolled;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Google\Client;
use Google\Service\Drive;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function getSignedUrl($lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        $isEnrolled = CourseEnrolled::where('id_course', $lesson->id_course)
            ->where('id_user', Auth::id())
            ->exists();

        if (!$isEnrolled) {
            return response()->json(['error' => 'Bạn chưa đăng ký khóa học này.'], 403);
        }

        $client = new Client();
        $client->setAuthConfig(storage_path('app/google-drive.json'));
        $client->addScope(Drive::DRIVE_READONLY);
        $client->setAccessType('offline');

        $driveService = new Drive($client);
        $file = $driveService->files->get($lesson->url, ['fields' => 'id,webContentLink']);

        return response()->json(['url' => $file->webContentLink]);
    }

}
