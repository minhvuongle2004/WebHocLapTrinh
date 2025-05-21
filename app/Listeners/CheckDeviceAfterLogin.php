<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use App\Helpers\DeviceHelper;
use App\Models\User; // hoặc App\Models\TblUser tùy tên bạn đặt

class CheckDeviceAfterLogin
{
    public function handle(Authenticated $event): void
    {
        $user = $event->user;

        // 👉 Chỉ kiểm tra nếu là user đăng nhập bằng guard 'web'
        if (!($user instanceof User)) {
            return; // Bỏ qua admin
        }

        $deviceId = DeviceHelper::getDeviceId();

        // if ($user->device_id === null) {
        //     $user->device_id = $deviceId;
        //     $user->save();
        // } elseif ($user->device_id !== $deviceId) {
        //     auth()->logout();
        //     abort(403, 'Tài khoản này chỉ được sử dụng trên một thiết bị.');
        // }
    }
}
