<?php

namespace App\Http\Interfaces\Services\Notification;

interface IPushNotificationService
{
    public function pushNotification(string $title, string $body, int $user): void;

}
