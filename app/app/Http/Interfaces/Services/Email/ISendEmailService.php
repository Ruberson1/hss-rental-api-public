<?php

namespace App\Http\Interfaces\Services\Email;

interface ISendEmailService
{
    public function emailNotification($data): void;

    public function emailBenefitsNotification(): void;
}
