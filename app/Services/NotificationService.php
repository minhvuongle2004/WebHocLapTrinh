<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    /**
     * Tạo thông báo mới
     */
    public function create(
        string $type,
        string $title,
        string $content,
        string $link,
        ?string $icon = null,
        ?string $iconColor = null,
        ?string $image = null,
        $sourceId = null,
        $sourceType = null
    ): Notification {
        return Notification::create([
            'type' => $type,
            'title' => $title,
            'content' => $content,
            'link' => $link,
            'icon' => $icon,
            'icon_color' => $iconColor,
            'image' => $image,
            'source_id' => $sourceId,
            'source_type' => $sourceType,
        ]);
    }

    /**
     * Đánh dấu thông báo đã đọc
     */
    public function markAsRead(int $notificationId): bool
    {
        $notification = Notification::find($notificationId);
        if ($notification) {
            $notification->read = true;
            return $notification->save();
        }
        return false;
    }

    /**
     * Lấy tất cả thông báo chưa đọc
     */
    public function getUnreadNotifications(int $limit = 10)
    {
        return Notification::where('read', false)
            ->latest()
            ->take($limit)
            ->get();
    }

    /**
     * Đếm số lượng thông báo chưa đọc
     */
    public function countUnreadNotifications(): int
    {
        return Notification::where('read', false)->count();
    }
}