<?php

namespace App\Jobs;

use App\Http\Services\Email\SendEmailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendBenefitsNotification implements ShouldQueue
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
        logs()->debug(now()->format('h:i:s d/m/Y').'enviou o e-mail');
        $emailBenefitsNotification = new SendEmailService();
        $emailBenefitsNotification->emailBenefitsNotification();
    }
}
