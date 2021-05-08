<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['throttle:global']], function () {
    // Authentication
    Auth::routes();

    // Welcome
    Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

    // Posts
    Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [\App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/{slug}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
    Route::post('/posts', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{slug}/edit', [\App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
    Route::patch('/posts/{slug}', [\App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{slug}', [\App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');

    // Photos
    Route::get('/photos', [\App\Http\Controllers\PhotoController::class, 'index'])->name('photos.index');
    Route::get('/photos/partial', [\App\Http\Controllers\PhotoController::class, 'photos'])->name('photos.partial');
    Route::get('/photos/{identifier}', [\App\Http\Controllers\PhotoController::class, 'show'])->name('photos.show');

    // CV
    Route::get('/cv', function () {
        $endpoint = config('services.cv.endpoint');

        return redirect($endpoint);
    })->name('cv');

    // Coffee
    Route::get('/coffee', [\App\Http\Controllers\CoffeeController::class, 'index'])->name('coffee.index');
    Route::post('/coffee', [\App\Http\Controllers\CoffeeController::class, 'store'])->name('coffee.store');
    Route::get('/coffee/confirm/{sessionId}', [\App\Http\Controllers\CoffeeController::class, 'confirm'])->name('coffee.confirm');
    Route::get('/coffee/success', [\App\Http\Controllers\CoffeeController::class, 'success'])->name('coffee.success');
    Route::get('/coffee/cancel', [\App\Http\Controllers\CoffeeController::class, 'cancel'])->name('coffee.cancel');

    // About
    Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about.index');

    // Contact
    Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'create'])->name('contact.create');
    Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

    // Privacy policy
    Route::get('/privacy-policy', [\App\Http\Controllers\PrivacyPolicyController::class, 'index'])->name('privacy-policy.index');
    Route::get('/privacy-policy/content', [\App\Http\Controllers\PrivacyPolicyController::class, 'content'])->name('privacy-policy.content');

    // Episodes
    Route::get('/podcast/episodes', [\App\Http\Controllers\EpisodeController::class, 'index'])->name('episodes.index');
    Route::get('/podcast/episodes/create', [\App\Http\Controllers\EpisodeController::class, 'create'])->name('episodes.create');
    Route::get('/podcast/episodes/{episode}', [\App\Http\Controllers\EpisodeController::class, 'show'])->name('episodes.show');
    Route::post('/podcast/episodes', [\App\Http\Controllers\EpisodeController::class, 'store'])->name('episodes.store');
    Route::get('/podcast/episodes/{episode}/edit', [\App\Http\Controllers\EpisodeController::class, 'edit'])->name('episodes.edit');
    Route::patch('/podcast/episodes/{episode}', [\App\Http\Controllers\EpisodeController::class, 'update'])->name('episodes.update');
    Route::delete('/podcast/episodes/{episode}', [\App\Http\Controllers\EpisodeController::class, 'destroy'])->name('episodes.destroy');

    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/home/posts', [\App\Http\Controllers\HomeController::class, 'posts'])->name('home.posts');
    Route::get('/home/episodes', [\App\Http\Controllers\HomeController::class, 'episodes'])->name('home.episodes');

    // App status
    Route::get('/app/status', function () {
        $code = $status = 200;
        $data = ['status' => 'OK', 'code' => $code];
        $headers = ['Content-Type' => 'application/json'];

        return response($data, $status, $headers);
    })->name('app.status');
});
