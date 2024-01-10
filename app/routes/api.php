<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Car\CarController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Reservation\ReservationController;
use App\Http\Controllers\WebNotification\WebNotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'token'
], function () {
    Route::post('/store-token', [WebNotificationController::class, 'storeToken']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'car'
], function () {
    Route::get('/list', [CarController::class, 'getAll']);
    Route::post('/register', [CarController::class, 'register']);
    Route::get('/available', [CarController::class, 'available']);
    Route::get('/{id}', [CarController::class, 'getOneById']);
    Route::put('/{id}', [CarController::class, 'update']);
    Route::patch('/{id}', [CarController::class, 'reserved']);
    Route::delete('/{id}', [CarController::class, 'delete']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'reservation'
], function () {
    Route::get('/list', [ReservationController::class, 'getAll']);
    Route::get('/history', [ReservationController::class, 'history']);
    Route::post('/register', [ReservationController::class, 'register']);
    Route::get('/{id}', [ReservationController::class, 'getById']);
    Route::get('/car-reservation/{car_id}', [ReservationController::class, 'getByCar']);
    Route::get('/user-reservation/{user_id}', [ReservationController::class, 'getByUser']);
    Route::put('/{id}', [ReservationController::class, 'update']);
    Route::patch('/{id}', [ReservationController::class, 'canceled']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'category'
], function () {
    Route::get('/list', [CategoryController::class, 'getAll']);
    Route::get('/{id}', [CategoryController::class, 'getById']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user/{id}', [AuthController::class, 'user']);
    Route::post('register', [AuthController::class, 'register']);
    Route::get('user-list', [AuthController::class, 'getAll']);
    Route::post('delete/{id}', [AuthController::class, 'delete']);
    Route::post('forgot-password', [AuthController::class, 'resetPass']);
    Route::post('reset-password', [AuthController::class, 'newPass']);
});
