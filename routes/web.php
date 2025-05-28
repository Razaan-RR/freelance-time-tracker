<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Middleware\SessionAuth;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('registrationPage');
});

Route::get('/registrationPage', function () {
    return view('registrationPage');
});
Route::post('/registrationPage', [AuthController::class, 'register_user']);

Route::get('/loginPage', function () {
    return view('loginPage');
});
Route::post('/loginPage', [AuthController::class, 'login_user']);

Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->middleware(SessionAuth::class);

Route::post('/logout', function () {
    session()->flush();
    return redirect('/loginPage');
});

Route::middleware(['web', App\Http\Middleware\SessionAuth::class])->group(function () {
    Route::get('/dashboard', [ClientController::class, 'list']);
    Route::post('/clients', [ClientController::class, 'add']);
});

Route::middleware(['web', App\Http\Middleware\SessionAuth::class])->group(function () {
    Route::post('/clients', [ClientController::class, 'add']);
    Route::post('/projects', [ProjectController::class, 'add']);
});

Route::patch('/projects/{project}/update-status', [ProjectController::class, 'updateStatus']);
