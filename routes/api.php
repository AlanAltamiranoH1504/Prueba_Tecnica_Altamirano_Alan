<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/usuario/save', [UserController::class, 'store']);
Route::put("/usuario/update/{id}", [UserController::class, "update"]);
Route::delete("/usuario/delete/{id}", [UserController::class, "destroy"]);
