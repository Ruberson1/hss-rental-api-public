<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Services\Auth\IAuthService;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Validation\Rules;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private readonly IAuthService $authService
    ){
        $this->middleware('auth:api', ['except' => [
            'login', 'register', 'forgot-password', 'reset-password','reset-password'
        ]]);
    }


    /**
     * Handle an incoming authentication request.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->authService->auth($request);
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): JsonResponse
    {
        return $this->authService->logout($request);
    }

    /**
     * Handle an incoming registration request.
     *
     */
    public function register(Request $request): JsonResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc,dns','string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'cpf' => ['required', 'string','max:11', 'min:11','unique:'.User::class],
            'password' => ['required', 'min:6', 'max:12','confirmed', Rules\Password::defaults()]

        ]);
        return $this->authService->register($request);

    }

    public function update(Request $request): JsonResponse
    {
        return $this->authService->update($request);
    }

    public function getAll(): JsonResponse
    {
        return $this->authService->userList();
    }

    public function delete(Request $request): JsonResponse
    {
        return $this->authService->deleteUser($request);
    }

    /**
     * Handle an incoming new password request.
     *
     */
    public function newPass(Request $request): JsonResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        return $this->authService->newPass($request);
    }

    /**
     * Handle an incoming password reset link request.
     *
     */
    public function resetPass(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        return $this->authService->resetPass($request);

    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function user(): JsonResponse
    {
        # Here we just get information about current user
        return $this->authService->user($request);
    }
}
