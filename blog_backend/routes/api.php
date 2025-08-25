<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('auth/register', [AuthController::class, 'register'])
    ->middleware('guest:sanctum');

Route::post('auth/login', [AuthController::class, 'login'])
    ->middleware('guest:sanctum');

Route::delete('auth/logout/{token?}', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');



Route::get('categories/main', [CategoryController::class, 'mainCategories']);
Route::get('categories/{id}/children', [CategoryController::class, 'children']);
// Route::apiResource('categories', CategoryController::class);

Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category}', [CategoryController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryController::class)
        ->except(['index', 'show']);
});




// Route::apiResource('posts', PostController::class);
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{post}', [PostController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('posts', PostController::class)
        ->except(['index', 'show']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/posts/{post}/comments', [CommentController::class, 'index']);
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::patch('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
});


Route::post('/likes/toggle', [LikeController::class, 'toggle'])->middleware('auth:sanctum');
