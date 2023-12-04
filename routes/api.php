<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\GoogleLoginController;
use  App\Http\Controllers\Api\NoteController;
use  App\Http\Controllers\AuthController;
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


Route::prefix('event')->group(function () {



    
    Route::post('create', [NoteController::class, 'create']);
    
    
    
        Route::get('all', [NoteController::class, 'index']);
        Route::post('update', [NoteController::class, 'update']);
        Route::delete('delete', [NoteController::class, 'delete']);


});


    


