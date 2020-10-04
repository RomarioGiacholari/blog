<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Route::get('/resume', function () {
    $resumeEndpoint = config('services.resume.endpoint');

    return redirect($resumeEndpoint);
})->name('resume');

Route::get('/app/status', function () {
    return [
        'status' => 'ok',
        'code'   => 200,
    ];
})->name('app.status');

Route::get('/coffee', [\App\Http\Controllers\CoffeeController::class, 'index'])->name('coffee.index');
Route::post('/coffee', [\App\Http\Controllers\CoffeeController::class, 'store'])->name('coffee.store');
Route::get('/coffee/confirm/{sessionId}', [\App\Http\Controllers\CoffeeController::class, 'confirm'])->name('coffee.confirm');
Route::get('/coffee/success', [\App\Http\Controllers\CoffeeController::class, 'success'])->name('coffee.success');
Route::get('/coffee/cancel', [\App\Http\Controllers\CoffeeController::class, 'cancel'])->name('coffee.cancel');

Auth::routes();

Route::get('/home/posts', [\App\Http\Controllers\HomeController::class, 'posts'])->name('home.posts');
Route::get('/home/episodes', [\App\Http\Controllers\HomeController::class, 'episodes'])->name('home.episodes');

Route::get('/all-photos', [\App\Http\Controllers\PhotoController::class, 'index'])->name('photos');
Route::get('/all-photos/partial', [\App\Http\Controllers\PhotoController::class, 'photos'])->name('photos.partial');
Route::get('/all-photos/{identifier}', [\App\Http\Controllers\PhotoController::class, 'show'])->name('photos.show');

Route::resource('posts', \App\Http\Controllers\PostController::class);

Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::get('/privacy-policy', [\App\Http\Controllers\PrivacyPolicyController::class, 'index'])->name('privacy-policy.index');
Route::get('/privacy-policy/content', [\App\Http\Controllers\PrivacyPolicyController::class, 'content'])->name('privacy-policy.content');

Route::get('/podcast/episodes', [\App\Http\Controllers\EpisodeController::class, 'index'])->name('episodes.index');
Route::get('/podcast/episodes/create', [\App\Http\Controllers\EpisodeController::class, 'create'])->name('episodes.create');
Route::get('/podcast/episodes/{episode}', [\App\Http\Controllers\EpisodeController::class, 'show'])->name('episodes.show');
Route::post('/podcast/episodes', [\App\Http\Controllers\EpisodeController::class, 'store'])->name('episodes.store');
Route::get('/podcast/episodes/{episode}/edit', [\App\Http\Controllers\EpisodeController::class, 'edit'])->name('episodes.edit');
Route::patch('/podcast/episodes/{episode}', [\App\Http\Controllers\EpisodeController::class, 'update'])->name('episodes.update');
Route::delete('/podcast/episodes/{episode}', [\App\Http\Controllers\EpisodeController::class, 'destroy'])->name('episodes.destroy');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about.index');

Route::prefix('/api')->group(function () {
    Route::get('/projects', [\App\Http\Controllers\ProjectApiController::class, 'index'])->name('api.projects.index');
    Route::get('/photos', [\App\Http\Controllers\PhotoApiController::class, 'index'])->name('api.photos.index');
});
