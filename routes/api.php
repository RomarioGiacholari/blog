<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['throttle:global']], function () {
    // Projects
    Route::get('/projects', [\App\Http\Controllers\ProjectApiController::class, 'index'])->name('api.projects.index');

    // Photos
    Route::get('/photos', [\App\Http\Controllers\PhotoApiController::class, 'index'])->name('api.photos.index');
});