<?php

namespace App\Http\Controllers\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Services\Reservation\IReservationService;
use App\Models\Car;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    public function __construct(
        private readonly IReservationService $reservationService
    )
    {
        $this->middleware('auth:api');
    }

    /**
     * Handle an incoming registration request.
     *
     */
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'user_id' => ['required', 'integer'],
            'start_reservation_date' => ['required','date'],
            'end_reservation_date' => ['required', 'date'],
        ]);
        return $this->reservationService->register($request);
    }

    public function getAll(Request $request): JsonResponse
    {
        return $this->reservationService->getAll($request);
    }

    public function history(Request $request): JsonResponse
    {
        return $this->reservationService->history($request);
    }


    public function getByCar(Request $request): JsonResponse
    {
        return $this->reservationService->getByCar($request);
    }

    public function getById(Request $request): JsonResponse
    {
        return $this->reservationService->getById($request);
    }

    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'car' => ['required'],
            'user_id' => ['required'],
            'start_reservation_date' => ['required','date'],
            'end_reservation_date' => ['required', 'date'],
        ]);
        return $this->reservationService->update($request);
    }

    public function getByUser(Request $request): JsonResponse
    {
        return $this->reservationService->getByUser($request);
    }

    public function canceled(Request $request): JsonResponse
    {
        return $this->reservationService->cancel($request);
    }
}
