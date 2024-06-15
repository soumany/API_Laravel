<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;

// Define API routes for the UserController
Route::resource('users', UserController::class);
Route::post('/rooms', [RoomController::class, 'store']);
Route::get('/rooms', [RoomController::class, 'index']);
Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);
Route::post('/send-otp-sms', [UserController::class, 'store']);
