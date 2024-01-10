<?php
namespace App\Http\Controllers\WebNotification;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebNotificationController extends Controller
{
    public function storeToken(Request $request): JsonResponse
    {
        $user = Auth::user();
        try {
            $reservation = User::findOrFail($user->getAuthIdentifier());
            $reservation->update([
                'device_key' =>  $request->token,
            ]);
            return response()->json(['mensagem' => 'token stored'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha ao registrar o token'], 404);
        }

    }
}
