<?php

namespace App\Jobs;

use App\Http\Services\Notification\PushNotificationService;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPushNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logs()->debug(now()->format('h:i:s d/m/Y').'enviou push notification');
        $users = User::all();
        foreach ($users as $user) {
            $notification = new PushNotificationService();
            $title = 'Ola! '. $user->name .', a previsão é de chuva?';
            $body = 'Para não ser pego de surpresa é melhor estar preparado, a HSS Rental pode te ajudar https://hssrental.netlify.app';
            $notification->pushNotification(title: $title, body:  $body, user: $user);
        }

    }
}
