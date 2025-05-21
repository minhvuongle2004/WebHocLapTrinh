<?php

namespace App\Observers;

use App\Models\CourseEnrolled;
use App\Services\NotificationService;

class CourseEnrolledObserver
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the CourseEnrolled "created" event.
     */
    public function created(CourseEnrolled $courseEnrolled): void
    {
        // Lấy thông tin user và course
        $user = $courseEnrolled->user;
        $course = $courseEnrolled->course;

        $this->notificationService->create(
            'course_enrolled',
            'Đăng ký khóa học mới',
            'Người dùng ' . $user->fullname . ' đã đăng ký khóa học "' . $courseEnrolled->title_course . '".',
            route('admin.courseEnrolled.show', $courseEnrolled->id),
            'fa-user-graduate',
            'success',
            $user->avatar ?? null,
            $courseEnrolled->id,
            CourseEnrolled::class
        );
    }

    /**
     * Handle the CourseEnrolled "updated" event.
     */
    public function updated(CourseEnrolled $courseEnrolled): void
    {
        // Kiểm tra nếu tiến độ học tập hoàn thành 100%
        if ($courseEnrolled->isDirty('progess') && $courseEnrolled->progess == 100) {
            $user = $courseEnrolled->user;

            $this->notificationService->create(
                'course_completed',
                'Khóa học hoàn thành',
                'Người dùng ' . $user->fullname . ' đã hoàn thành khóa học "' . $courseEnrolled->title_course . '".',
                route('admin.courseEnrolled.show', $courseEnrolled->id),
                'fa-check-circle',
                'primary',
                $user->avatar ?? null,
                $courseEnrolled->id,
                CourseEnrolled::class
            );
        }
    }
}
