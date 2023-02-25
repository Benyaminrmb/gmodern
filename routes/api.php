<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', [\App\Http\Controllers\Auth\UserAuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Auth\UserAuthController::class, 'login']);

Route::middleware('auth:api')
    ->get('/user', [\App\Http\Controllers\Auth\UserAuthController::class, 'getUser']);

Route::middleware('auth:api')->group(function () {
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'mainData']);
    Route::get('/user', [\App\Http\Controllers\Auth\UserAuthController::class, 'getUser']);
});

Route::put('/post/{id}/like', [\App\Http\Controllers\PostController::class, 'likePost']);
Route::put('/post/{id}/dislike', [\App\Http\Controllers\PostController::class, 'dislikePost']);
Route::post('/get/posts', [\App\Http\Controllers\PostController::class, 'getList']);
Route::post('/get/posts/category/{id}', [\App\Http\Controllers\PostController::class, 'getListByCategory']);
Route::post('/get/posts/source/{id}', [\App\Http\Controllers\PostController::class, 'getListBySource']);
Route::get('/post/{id}', [\App\Http\Controllers\PostController::class, 'getDetail']);
Route::post('/get/categories', [\App\Http\Controllers\CategoryController::class, 'getList']);
Route::post('/get/category/{id}', [\App\Http\Controllers\PostController::class, 'getListByCategory']);

Route::apiResource('/logs', \App\Http\Controllers\LogController::class)->only('store');
Route::get('/sources', [\App\Http\Controllers\SourceController::class, 'getAllSources']);

Route::get('/crawler', [\App\Http\Controllers\CrawlerController::class, 'run']);
Route::middleware(['auth:api', 'admin'])->prefix('admin')->group(function () {
    Route::get('/user', [\App\Http\Controllers\UserController::class, 'getUsers']);
    Route::prefix('post')->group(function () {
        Route::get('/', [\App\Http\Controllers\PostController::class, 'getAdminList']);
        Route::put('/{post}', [\App\Http\Controllers\PostController::class, 'postUpdate']);
    });
});
