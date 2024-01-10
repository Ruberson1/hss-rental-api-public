<?php

namespace App\Http\Interfaces\Repositories\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface IAuthRepository
{
    public function register(Request $request): JsonResponse;

    public function update(Request $request): JsonResponse;

    public function userList(): JsonResponse;

    public function deleteUser(Request $request): \Illuminate\Http\JsonResponse;
}
