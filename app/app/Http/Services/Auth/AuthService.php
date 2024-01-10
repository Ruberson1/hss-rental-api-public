<?php

namespace App\Http\Services\Auth;

use App\Http\Interfaces\Services\Auth\IAuthService;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Permission;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthService implements IAuthService
{

    public function auth(LoginRequest $request): JsonResponse
    {
        Auth::factory()->setTTL(720);
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout(Request $request): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function deleteUser(Request $request): JsonResponse
    {
        try {
            $user = User::find($request->id);
            $user->delete();
            return response()->json([
                'message' => 'User deleted successfully.'
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'error' => 'Failed to delete user.',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function newPass(Request $request): JsonResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status != Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }

        return response()->json(['status' => __($status)]);
    }

    public function resetPass(Request $request): JsonResponse
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }

        return response()->json(['status' => __($status)]);
    }

    public function register(Request $request): JsonResponse
    {
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->cpf = $request->cpf;
            $user->password = Hash::make($request->password);

            $user->save();

            $permission = Permission::find(env('CUSTOMER_PERMISSION', 3));
            $user->permissions()->save($permission);

            event(new Registered($user));

            Auth::login($user);
            return response()->json([
                'message' => 'Usuário criado com sucesso.'
            ], 201);
        } catch (Exception $exception) {
            return response()->json([
                'error' => 'Falha ao tentar criar o usuário.',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function user(Request $request): JsonResponse
    {
        $userId = $request->user_id;
        try {
            $user = User::findOrFail($userId);
            return response()->json($user);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }
    }

    public function update(Request $request): JsonResponse
    {
        $userId = $request->id;

        try {
            $user = User::find($userId);
            $user->update($request->only([
                'name', 'email'
            ]));
            $permission = Permission::find($request->permission);
            $user->permissions()->sync($permission);
            return response()->json($user);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }
    }

    public function userList(): JsonResponse
    {
        $users = User::all();

        return response()->json($users);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        # This function is used to make JSON response with new
        # access token of current user
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => \auth()->user()
        ]);
    }
}
