<?php

namespace App\Providers;

use App\Models\Course;
use App\Observers\CourseObserver;
use Illuminate\Auth\Events\Authenticated;
use App\Listeners\CheckDeviceAfterLogin;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Authenticated::class => [
            CheckDeviceAfterLogin::class,
        ],
    ];

    public function shouldDiscoverEvents(): bool
    {
        return false; // ✅ Tắt auto-discovery ở đây
    }

    public function boot()
    {
        parent::boot();

        // Đăng ký observer
        Course::observe(CourseObserver::class);
    }
}
