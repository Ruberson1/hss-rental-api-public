<?php

namespace App\Http\Services\Email;

use App\Http\Interfaces\Services\Email\ISendEmailService;
use App\Mail\ConfirmationEmail;
use App\Mail\EmailBenefits;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendEmailService implements ISendEmailService
{

    public function emailNotification($data): void
    {
        Mail::to($data['user_email'])->send(new ConfirmationEmail($data));
    }

    public function emailBenefitsNotification(): void
    {
        $users = User::all();
        $emails = $users->pluck('email')->toArray();

        Mail::to($emails)->send(new EmailBenefits());
    }
}
