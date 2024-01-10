<?php

namespace App\Listeners;

use App\Http\Interfaces\Services\Notification\IPushNotificationService;
use App\Models\Car;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPushNotification
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private readonly IPushNotificationService $pushNotificationService
    ){}


    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = User::findOrFail($event->request->user_id);
        $reservation = Reservation::findOrFail($event->request->id);
        $title = 'Ola! '. $user->name .', Locação confirmada';
        $body = 'Sua retirada será no dia '.$reservation->start_reservation_date->format('d-m-Y H:i:s') . ' você pode alterar ou cancelar a reserva até 24 horas antes da data de retirada.';

        $this->pushNotificationService->pushNotification(title: $title, body: $body, user: $user);
    }
}
