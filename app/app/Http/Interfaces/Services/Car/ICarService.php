<?php

namespace App\Http\Interfaces\Services\Car;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface ICarService
{
    public function register(Request $request): JsonResponse;

    public function availableCars(Request $request): JsonResponse;

    public function getAll(Request $request): JsonResponse;

    public function getOneById(Request $request): JsonResponse;

    public function update(Request $request): JsonResponse;

    public function reserved(Request $request): JsonResponse;

    public function delete(Request $request): JsonResponse;

}
