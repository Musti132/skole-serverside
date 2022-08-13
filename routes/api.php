<?php

use App\Http\Controllers\Api\ChannelController;
use App\Http\Controllers\Api\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'v1',
    'as' => 'api.',
], function () {

    Route::group([
        'prefix' => 'auth',
        'as' => 'auth.',
    ], function() {

        Route::controller(AuthController::class)->group(function() {

            Route::middleware('auth:sanctum')->group(function() {
                Route::post('logout', 'logout');
                Route::post('refresh', 'refresh');
                Route::post('me', 'me');
            });

            Route::post('register', 'register');
            Route::post('login', 'login')->name('login');
        });
    });



    Route::group([
        'as' => 'channels',
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::controller(ChannelController::class)->group(function () {
            Route::get('channels', 'index');
        });
    });
});
