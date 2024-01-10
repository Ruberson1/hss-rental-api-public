<?php

namespace App\Http\Interfaces\Services\Reservation;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface IReservationService
{
    public function register(Request $request): JsonResponse;

    public function getAll(Request $request): JsonResponse;

    public function history(Request $request): JsonResponse;

    public function getByCar(Request $request): JsonResponse;

    public function getById(Request $request): JsonResponse;

    public function update(Request $request): JsonResponse;

    public function getByUser(Request $request): JsonResponse;

    public function cancel(Request $request): JsonResponse;
}
