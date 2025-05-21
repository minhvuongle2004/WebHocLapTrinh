<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\CourseEnrolled;
use App\Models\Message;
use App\Models\Payment;
use App\Models\User;
use App\Observers\CourseEnrolledObserver;
use App\Observers\CourseObserver;
use App\Observers\MessageObserver;
use App\Observers\PaymentObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Course::observe(CourseObserver::class);
        CourseEnrolled::observe(CourseEnrolledObserver::class);
        Message::observe(MessageObserver::class);
        Payment::observe(PaymentObserver::class);
        User::observe(UserObserver::class);
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
