<?php

use App\Http\Controllers\Api\V1\App\PostController;
use App\Http\Controllers\Api\V1\App\UserController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "auth:sanctum"], function () {
    Route::get("/post", [PostController::class, "index"]);
    Route::get("/post/{post}", [PostController::class, "show"]);

    Route::get("/user", [UserController::class, "index"]);
    Route::get("/user/{user}", [UserController::class, "show"]);
});