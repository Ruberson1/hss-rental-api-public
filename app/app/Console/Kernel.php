<?php

namespace App\Console;

use App\Http\Interfaces\Services\Email\ISendEmailService;
use App\Jobs\SendBenefitsNotification;
use App\Jobs\SendPushNotificationJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->job(job: new SendBenefitsNotification())->dailyAt('10:00');
        $schedule->job(job: new SendPushNotificationJob())->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
