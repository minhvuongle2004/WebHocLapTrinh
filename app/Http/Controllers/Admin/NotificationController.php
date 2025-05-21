<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Đánh dấu thông báo đã đọc và chuyển hướng
     */
    public function read(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);
        $link = $notification->link;

        $this->notificationService->markAsRead($id);

        return redirect($link);
    }

    /**
     * Hiển thị tất cả thông báo
     */
    public function index()
    {
        $notifications = Notification::latest()->paginate(15);
        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Đánh dấu tất cả thông báo đã đọc
     */
    public function markAllAsRead()
    {
        Notification::where('read', false)->update(['read' => true]);

        return redirect()->back()->with('success', 'Tất cả thông báo đã được đánh dấu là đã đọc.');
    }
}