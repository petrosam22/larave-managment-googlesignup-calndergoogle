<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});


Route::get('auth/google', [AuthController::class,'redirectToGoogle'])->name('auth.google');

Route::get('auth/google/callback', [AuthController::class,'handleGoogleCallback']);
Route::get('logout', [AuthController::class,'logout'])->name('logout');
Route::get('token', [AuthController::class,'token'])->name('token');




Route::get('create/note', [NoteController::class,'create'])->name('note.create');
Route::get('notes', [NoteController::class,'index'])->name('notes');
Route::post('store', [NoteController::class,'store'])->name('store');
