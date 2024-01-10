<?php

namespace App\Http\Services\Reservation;

use App\Events\ConfirmReservation;
use App\Http\Interfaces\Repositories\Car\ICarRepository;
use App\Http\Interfaces\Repositories\Reservation\IReservationRepository;
use App\Http\Interfaces\Services\Reservation\IReservationService;
use App\Listeners\SendPushNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ReservationService implements IReservationService
{

    public function __construct(
        private readonly IReservationRepository $reservationRepository,
    )
    {
    }

    public function register(Request $request): JsonResponse
    {

        $isOutOfValidPeriod = $this->checkValidPeriod($request);

        if($isOutOfValidPeriod){
            return response()->json(
                [
                    'error' => 'A data de retirada ou devolução não pode ser menor que a data atual'
                ],
                401
            );
        }

        return $this->reservationRepository->register($request);
    }

    public function getAll(Request $request): JsonResponse
    {
        return $this->reservationRepository->getAll($request);
    }

    public function history(Request $request): JsonResponse
    {
        return $this->reservationRepository->history($request);
    }

    public function getByCar(Request $request): JsonResponse
    {
        return $this->reservationRepository->getByCar($request);
    }

    public function getById(Request $request): JsonResponse
    {
        return $this->reservationRepository->getById($request);
    }

    public function update(Request $request): JsonResponse
    {
        $isOutOfValidPeriod = $this->checkValidPeriod(request: $request);

        if($isOutOfValidPeriod){
            return response()->json(
                [
                    'error' => 'A data de retirada ou devolução não pode ser menor que a data atual'
                ],
                403
            );
        }
        $result = json_decode($this->reservationRepository->update(request: $request)->status());
        if ($result === ResponseAlias::HTTP_OK) {
            ConfirmReservation::dispatch($request);
            return response()->json([
                'message' => 'Locação confirmada com sucesso.'
            ], 200);
        }


        return $this->reservationRepository->update($request);
    }

    public function getByUser(Request $request): JsonResponse
    {
        return $this->reservationRepository->getByUser($request);
    }

    public function cancel(Request $request): JsonResponse
    {
        return $this->reservationRepository->cancel($request);
    }

    protected function checkValidPeriod(Request $request): bool
    {
        $today = new \DateTime();
        return $request->start_reservation_date < $today->format('Y-m-d H:i:s')
            || $request->end_reservation_date < $today->format('Y-m-d H:i:s');

    }
}
