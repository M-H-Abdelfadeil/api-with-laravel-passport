<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {

    Route::post('register', [AuthController::class , 'register']);
    Route::post('login', [AuthController::class , 'login']);


    Route::group(['middleware' => 'auth.api'], function () {
        Route::get('posts/trashed', [PostController::class, 'trashed']);
        Route::post('posts/restore/{post}', [PostController::class, 'restore']);
        Route::delete('posts/force-delete/{post}', [PostController::class, 'force_delete']);
        Route::apiResource('posts', PostController::class);
    });

});

