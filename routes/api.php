<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//Endpoit de prueba de encriptacion
Route::get("/prueba/encripctacion", [UserController::class, "pruebaEncriptado"]);

Route::post('/usuario/save', [UserController::class, 'store']);
Route::post("/token", [\App\Http\Controllers\TokenController::class, "getToken"]);
Route::middleware("auth:sanctum")->group(function () {
    Route::put("/usuario/update/{id}", [UserController::class, "update"]);
    Route::delete("/usuario/delete/{id}", [UserController::class, "destroy"]);
});
