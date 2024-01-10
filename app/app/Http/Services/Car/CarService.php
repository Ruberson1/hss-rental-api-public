<?php

namespace App\Http\Services\Car;

use App\Http\Interfaces\Repositories\Car\ICarRepository;
use App\Http\Interfaces\Services\Car\ICarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarService implements ICarService
{

    public function __construct(
        private readonly ICarRepository $carRepository
    )
    {
    }

    public function register(Request $request): JsonResponse
    {
        return $this->carRepository->register($request);
    }

    public function availableCars(Request $request): JsonResponse
    {
        return $this->carRepository->availableCars($request);
    }

    public function getAll(Request $request): JsonResponse
    {
        return $this->carRepository->getAll($request);
    }

    public function getOneById(Request $request): JsonResponse
    {
        $carId = $request->id;
        return $this->carRepository->getOneById(carId: $carId);
    }

    public function update(Request $request): JsonResponse
    {
        return $this->carRepository->update($request);
    }

    public function reserved(Request $request): JsonResponse
    {
        $carId = $request->id;
        $isReserved = $request->reserved;
        return $this->carRepository->reserved(carId: $carId, isReserved: $isReserved);
    }

    public function delete(Request $request): JsonResponse
    {
        return $this->carRepository->delete($request);
    }
}
