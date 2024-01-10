<?php

namespace App\Http\Repositories\Reservation;

use App\Http\Interfaces\Repositories\Reservation\IReservationRepository;
use App\Models\Permission;
use App\Models\Reservation;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationRepository implements IReservationRepository
{

    public function register(Request $request): JsonResponse
    {
        try {
            $reservation = new Reservation();
            $reservation->car_id = $request->car_id;
            $reservation->user_id = $request->user_id;
            $reservation->start_reservation_date = $request->start_reservation_date;
            $reservation->end_reservation_date = $request->end_reservation_date;
            $reservation->category_id = $request->category_id;

            $reservation->save();
            return response()->json([
                'message' => 'Locação solicitada com sucesso.'
            ], 201);
        } catch (Exception $exception) {
            return response()->json([
                'error' => 'Falha ao tentar criar a Locação.',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function getAll(Request $request): JsonResponse
    {
        $reservations = Reservation::where('confirm_reservation', false)
            ->orderBy('start_reservation_date', 'asc') // ou 'desc' para ordenação descendente
            ->get();

        return response()->json($reservations);
    }

    public function history(Request $request): JsonResponse
    {
        $user = Auth::user();

        $permission = $user->permissions();

        if ($permission->first()->id == env('CUSTOMER_PERMISSION')){
            $reservations = Reservation::where('user_id', $user->getAuthIdentifier())
                ->orderBy('start_reservation_date', 'desc') // ou 'desc' para ordenação descendente
                ->get();

            return response()->json($reservations);
        }

        $reservations = Reservation::orderBy('start_reservation_date', 'desc')->get();

        return response()->json($reservations);
    }


    public function getByCar(Request $request): JsonResponse
    {
        $carId = $request->car_id;

        try {
            $reservation = Reservation::where('car_id', $carId)->get();
            return response()->json($reservation);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Locação não encontrada'], 404);
        }
    }

    public function getById(Request $request): JsonResponse
    {
        $id = $request->id;

        try {
            $reservation = Reservation::where('id', $id)->get();
            return response()->json($reservation);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Locação não encontrada'], 404);
        }
    }

    public function update(Request $request): JsonResponse
    {
        $reservationId = $request->id;

        try {
            $reservation = Reservation::findOrFail($reservationId);
            $reservation->update([
                'start_reservation_date' =>  $request->start_reservation_date,
                'end_reservation_date' => $request->end_reservation_date,
                'car_id' => $request->car['id'],
                'confirm_reservation' => true
            ]);
            return response()->json($reservation, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Locação não encontrada'], 404);
        }
    }

    public function getByUser(Request $request): JsonResponse
    {
        $userId = $request->user_id;

        try {
            $reservation = Reservation::where('user_id', $userId)->get();
            return response()->json($reservation);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Locação não encontrada'], 404);
        }
    }

    public function cancel(Request $request): JsonResponse
    {
        $reservationId = $request->id;
        $canceled = $request->validate([
            'canceled' => 'boolean',
        ]);

        try {
            $reservation = Reservation::findOrFail($reservationId);
            $reservation->canceled = $canceled['canceled'];
            $reservation->save();
            return response()->json(['message' => 'Locação cancelada'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Locação não encontrada'], 404);
        }
    }
}
