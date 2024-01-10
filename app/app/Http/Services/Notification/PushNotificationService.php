<?php

namespace App\Http\Services\Notification;

use App\Http\Interfaces\Services\Notification\IPushNotificationService;

class PushNotificationService implements IPushNotificationService
{

    public function pushNotification(string $title, string $body, $user): void
    {
        if (!$user->device_key) return;
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = [$user->device_key];

        $serverKey = env('FCM_SERVER_KEY');
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $title,
                "body" => $body,
            ]
        ];
        $encodedData = json_encode($data);


        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post

        $result = curl_exec($ch);
        if ($result === FALSE) {
            dd('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        // FCM response
//        dd($result);

    }
}
