<?php

namespace App\Http\Interfaces\Services\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

interface IAuthService
{
    public function auth(LoginRequest $request): JsonResponse;

    public function logout(Request $request): JsonResponse;

    public function deleteUser(Request $request): \Illuminate\Http\JsonResponse;

    public function newPass(Request $request): JsonResponse;

    public function resetPass(Request $request): JsonResponse;

    public function user(Request $request): JsonResponse;

    public function register(Request $request): JsonResponse;

    public function update(Request $request): JsonResponse;

    public function userList(): JsonResponse;
}
