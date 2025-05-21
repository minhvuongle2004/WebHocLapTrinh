<?php

namespace App\Observers;

use App\Models\Course;
use App\Services\NotificationService;

class CourseObserver
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the Course "created" event.
     */
    public function created(Course $course): void
    {
        $this->notificationService->create(
            'course_created',
            'Khóa học mới được tạo',
            'Khóa học "' . $course->title . '" đã được thêm vào hệ thống.',
            route('admin.courses.show', $course->id),
            'fa-graduation-cap',
            'primary',
            $course->thumbnail ?? null,
            $course->id,
            Course::class
        );
    }

    /**
     * Handle the Course "updated" event.
     */
    public function updated(Course $course): void
    {
        // Kiểm tra xem trạng thái có thay đổi không
        if ($course->isDirty('status')) {
            $statusText = $course->status == 1 ? 'kích hoạt' : 'vô hiệu hóa';

            $this->notificationService->create(
                'course_status_changed',
                'Trạng thái khóa học thay đổi',
                'Khóa học "' . $course->title . '" đã được ' . $statusText . '.',
                route('admin.courses.show', $course->id),
                'fa-toggle-on',
                'warning',
                $course->thumbnail ?? null,
                $course->id,
                Course::class
            );
        }
    }
}