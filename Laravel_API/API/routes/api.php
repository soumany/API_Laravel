<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CombinedDataController;

// Define API routes for the UserController
Route::resource('users', UserController::class);
Route::post('/rooms', [RoomController::class, 'store']);
// Route::post('/floors', [FloorController::class, 'store']);
Route::get('/rooms', [RoomController::class, 'index']);
// Route::get('/floors', [FloorController::class, 'index']);
Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);

// Route::delete('/floors/{id}', [FloorController::class, 'destroy']);
Route::put('/rooms/{id}', 'RoomController@update');

Route::apiResource('homes', HomeController::class);
Route::apiResource('floors', FloorController::class);
Route::get('/combined-data', [CombinedDataController::class, 'fetchData']);

//fb
Route::get('/auth/facebook', 'Auth\LoginController@redirectToFacebook');
Route::get('/auth/facebook/callback', 'Auth\LoginController@handleFacebookCallback');