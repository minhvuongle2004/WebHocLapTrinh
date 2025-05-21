<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\DeviceHelper;
use Illuminate\Support\Facades\Auth;

class CheckDeviceMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $currentDeviceId = DeviceHelper::getDeviceId();

            if ($user->device_id === null) {
                // Lưu lần đầu
                $user->device_id = $currentDeviceId;
                $user->save();
            } elseif ($user->device_id !== $currentDeviceId) {
                // Không đúng thiết bị
                return response()->view('errors.device_blocked', [], 403);
            }
        }

        return $next($request);
    }
}
