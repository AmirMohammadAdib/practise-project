<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


Route::post("/login", [LoginController::class, "login"]);
Route::post("/register", [RegisterController::class, "register"])->name("register");
Route::get("/logout", [LogoutController::class, "logout"])->middleware("auth:sanctum");