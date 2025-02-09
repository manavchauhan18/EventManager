<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\AttendanceController;



Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function () {
    Route::post('/invite', [InvitationController::class, 'store']);
    Route::post('/attendance', [AttendanceController::class, 'markAttendance']);
    Route::post('/events', [EventController::class, 'store']);
    Route::get('/events', [EventController::class, 'index']);
// });
