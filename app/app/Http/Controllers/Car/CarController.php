<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Services\Car\ICarService;
use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class CarController extends Controller
{

    public function __construct(
       private readonly ICarService $carService
    ){
        $this->middleware('auth:api');
    }


    /**
     * Handle an incoming registration request.
     *
     */
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'year' => ['required','max:4', 'integer'],
            'plate' => ['required', 'string','max:7', 'unique:'.Car::class],
            'category_id' => ['required', 'integer'],
            'reserved' => ['required', 'bool'],
        ]);

        return $this->carService->register($request);
    }

    public function available(Request $request): JsonResponse
    {
        return $this->carService->availableCars($request);
    }

    public function getAll(Request $request): JsonResponse
    {
        return $this->carService->getAll($request);
    }

    public function getOneById(Request $request): JsonResponse
    {
        return $this->carService->getOneById($request);
    }

    public function update(Request $request): JsonResponse
    {
        return $this->carService->update($request);
    }

    public function reserved(Request $request): JsonResponse
    {
        return $this->carService->reserved($request);
    }

    public function delete(Request $request): JsonResponse
    {
        return $this->carService->delete($request);
    }
}
