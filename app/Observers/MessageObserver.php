<?php

namespace App\Observers;

use App\Models\Message;
use App\Services\NotificationService;

class MessageObserver
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the Message "created" event.
     */
    public function created(Message $message): void
    {
        $sender = $message->sender;
        $receiver = $message->receiver;

        // Tạo thông báo cho admin về tin nhắn mới
        $this->notificationService->create(
            'new_message',
            'Tin nhắn mới',
            'Người dùng ' . $sender->fullname . ' đã gửi tin nhắn cho ' . $receiver->fullname . '.',
            route('admin.messages.show', $message->id),
            'fa-envelope',
            'info',
            $sender->avatar ?? null,
            $message->id,
            Message::class
        );
    }
}