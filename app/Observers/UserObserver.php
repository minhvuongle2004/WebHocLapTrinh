<?php

namespace App\Observers;

use App\Models\User;
use App\Services\NotificationService;

class UserObserver
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $this->notificationService->create(
            'user_registered',
            'Người dùng mới đăng ký',
            'Người dùng ' . $user->fullname . ' (' . $user->email . ') đã đăng ký tài khoản.',
            route('admin.users.show', $user->id),
            'fa-user-plus',
            'info',
            $user->avatar ?? null,
            $user->id,
            User::class
        );
    }
}