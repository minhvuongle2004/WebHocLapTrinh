<?php

namespace App\Helpers;

class DeviceHelper
{
    public static function getDeviceId(): string
    {
        $userAgent = request()->header('User-Agent') ?? 'unknown';
        $ip = request()->ip() ?? 'unknown';

        return hash('sha256', $userAgent . $ip);
    }
}
