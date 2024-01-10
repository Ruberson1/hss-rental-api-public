<?php

namespace App\Http\Repositories\Car;

use App\Http\Interfaces\Repositories\Car\ICarRepository;
use App\Models\Car;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class CarRepository implements ICarRepository
{

    public function register(Request $request): JsonResponse
    {
        try {
            $car = new Car();
            $car->brand = $request->brand;
            $car->model = $request->model;
            $car->plate = $request->plate;
            $car->year = $request->year;
            $car->reserved = $request->reserved;
            $car->category_id = $request->category_id;

            $car->save();
            return response()->json([
                'message' => 'veículo registrado com sucesso.'
            ], 201);
        } catch (Exception $exception) {
            return response()->json([
                'error' => 'Falha ao tentar registrar o veículo.',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function availableCars(Request $request): JsonResponse
    {
        $category_id = $request->category_id;
        $start_date = $request->start_reservation_date;
        $end_date = $request->end_reservation_date;

        $availableCars = Car::where('cars.category_id', $category_id)
            ->leftJoin('reservations', function ($join) use ($start_date, $end_date) {
                $join->on('cars.id', '=', 'reservations.car_id')
                    ->where(function ($query) use ($start_date, $end_date) {
                        $query->whereBetween('start_reservation_date', [$start_date, $end_date])
                            ->orWhereBetween('end_reservation_date', [$start_date, $end_date])
                            ->orWhere(function ($query) use ($start_date, $end_date) {
                                $query->where('start_reservation_date', '<', $start_date)
                                    ->where('end_reservation_date', '>', $end_date);
                            });
                    });
            })
            ->whereNull('reservations.car_id') // Excluir carros com reservas
            ->select('cars.*')
            ->get();

        return response()->json($availableCars, 200);
    }



    public function getAll(Request $request): JsonResponse
    {
        $cars = Car::all();

        return response()->json($cars);
    }

    public function getOneById(int $carId): JsonResponse
    {
        try {
            $car = Car::findOrFail($carId);
            return response()->json($car);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Veículo não encontrado'], 404);
        }
    }

    public function update(Request $request): JsonResponse
    {
        $carId = $request->id;

        try {
            $car = Car::findOrFail($carId);
            $car->update($request->all());
            return response()->json($car);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Veículo não encontrado'], 404);
        }
    }

    public function reserved(int $carId, bool $isReserved): JsonResponse
    {
        try {
            $car = Car::findOrFail($carId);
            $car->reserved = $isReserved;
            $car->save();
            return response()->json(['message' => 'Status alterado com sucesso'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => ' Veículo não encontrado'], 404);
        }
    }

    public function delete(Request $request): JsonResponse
    {
        $carId = $request->id;

        try {
            $car = Car::findOrFail($carId);
            $car->delete();
            return response()->json(['message' => 'Veículo deletado'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Veículo não encontrado'], 404);
        }
    }
}
