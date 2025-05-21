<?php

namespace App\Observers;

use App\Models\Payment;
use App\Services\NotificationService;

class PaymentObserver
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the Payment "created" event.
     */
    public function created(Payment $payment): void
    {
        $user = $payment->user;
        $course = $payment->course;

        $this->notificationService->create(
            'payment_created',
            'Thanh toán mới',
            'Người dùng ' . $user->fullname . ' đã thanh toán ' . number_format($payment->amount) . ' VNĐ cho khóa học "' . $course->title . '".',
            route('admin.payments.show', $payment->id),
            'fa-credit-card',
            'success',
            null,
            $payment->id,
            Payment::class
        );
    }

    /**
     * Handle the Payment "updated" event.
     */
    public function updated(Payment $payment): void
    {
        // Nếu trạng thái thanh toán thay đổi
        if ($payment->isDirty('status')) {
            $user = $payment->user;
            $course = $payment->course;
            $statusText = '';
            $iconColor = 'primary';

            switch ($payment->status) {
                case 'success':
                    $statusText = 'thành công';
                    $iconColor = 'success';
                    break;
                case 'failed':
                    $statusText = 'thất bại';
                    $iconColor = 'danger';
                    break;
                case 'pending':
                    $statusText = 'đang xử lý';
                    $iconColor = 'warning';
                    break;
                default:
                    $statusText = $payment->status;
            }

            $this->notificationService->create(
                'payment_status_changed',
                'Cập nhật trạng thái thanh toán',
                'Thanh toán của ' . $user->fullname . ' cho khóa học "' . $course->title . '" có trạng thái ' . $statusText . '.',
                route('admin.payments.show', $payment->id),
                'fa-money-bill',
                $iconColor,
                null,
                $payment->id,
                Payment::class
            );
        }
    }
}