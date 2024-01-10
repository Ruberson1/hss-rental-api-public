<?php

namespace App\Listeners;

use App\Http\Interfaces\Services\Email\ISendEmailService;
use App\Models\Car;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailConfirmation
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private readonly ISendEmailService $sendEmailService
    ){}

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $car = Car::findOrFail($event->request->car['id']);
        $user = User::findOrFail($event->request->user_id);

        $data = [
            'user_name' => $user->name,
            'user_email' => $user->email,
            'model_car' => $car->model,
            'brand_car' => $car->brand,
            'year_car' => $car->year,
            'plate_car' => $car->plate,
            'start_reservation_date' => $event->request->start_reservation_date,
            'end_reservation_date' => $event->request->end_reservation_date
        ];

        $this->sendEmailService->emailNotification($data);
    }
}
