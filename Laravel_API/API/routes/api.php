<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BuildingController;

// Define API routes for the UserController
Route::resource('users', UserController::class);
Route::post('/rooms', [RoomController::class, 'store']);
Route::post('/building', [BuildingController::class, 'store']);
Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/building', [BuildingController::class, 'index']);
Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);
Route::delete('/building/{id}', [BuildingController::class, 'destroy']);

