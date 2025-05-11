<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;





Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('posts', PostController::class);
    Route::apiResource('posts.comments', CommentController::class)->shallow();
    Route::apiResource('tags', TagController::class);
    Route::post('/logout', [AuthController::class, 'logout']);

    // You will add post/comment/tag routes here later
});