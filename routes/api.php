<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    
});

// Route::middleware('auth:api')->get('/athenticated', function (Request $request) {
//     return true;
    
// });

// Route::middleware('auth:sanctum')->get('/athenticated', function () {
//     return true;
// });

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth.role:1')->group(function () {
    Route::post('/create', [UserController::class, 'create']);
    Route::get('/users', [UserController::class, 'getUser']);
    Route::get('/athenticated', [UserController::class, 'getAuthenticatedUser']);
    Route::put('/update/{id}', [UserController::class, 'edit']);
    Route::delete('/delete/{id}', [UserController::class, 'delete']);
});




