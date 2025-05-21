<?php

namespace App\View\Components;

use App\Services\NotificationService;
use Illuminate\View\Component;

class NotificationList extends Component
{
    public $notifications;
    public $unreadCount;

    public function __construct(NotificationService $notificationService)
    {
        $this->notifications = $notificationService->getUnreadNotifications();
        $this->unreadCount = $notificationService->countUnreadNotifications();
    }

    public function render()
    {
        return view('components.notification-list');
    }
}