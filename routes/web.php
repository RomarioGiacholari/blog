<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/resume', function () {
    $pathToFile = public_path('resume.pdf');
    
    return response()->file($pathToFile);
})->name('resume');

Route::get('/coffee', 'CoffeeController@index')->name('coffee.index');
Route::post('/coffee', 'CoffeeController@store')->name('coffee.store');
Route::get('/coffee/confirm/{sessionId}', 'CoffeeController@confirm')->name('coffee.confirm');
Route::get('/coffee/success', 'CoffeeController@success')->name('coffee.success');

Auth::routes();

Route::get('/home/posts', 'HomeController@posts')->name('home.posts');
Route::get('/home/episodes', 'HomeController@episodes')->name('home.episodes');

Route::get('/all-photos', 'PhotoController@index')->name('photos');
Route::get('/all-photos/{identifier}', 'PhotoController@show')->name('photos.show');
Route::resource('posts', 'PostController');

Route::get('/contact', 'ContactController@create')->name('contact.create');
Route::post('/contact', 'ContactController@store')->name('contact.store');

Route::get('/privacy-policy', 'PrivacyPolicyController@index')->name('privacy-policy.index');

Route::get('/podcast/episodes', 'EpisodeController@index')->name('episodes.index');
Route::get('/podcast/episodes/create', 'EpisodeController@create')->name('episodes.create');
Route::get('/podcast/episodes/{episode}', 'EpisodeController@show')->name('episodes.show');
Route::post('/podcast/episodes', 'EpisodeController@store')->name('episodes.store');
Route::get('/podcast/episodes/{episode}/edit', 'EpisodeController@edit')->name('episodes.edit');
Route::patch('/podcast/episodes/{episode}', 'EpisodeController@update')->name('episodes.update');
Route::delete('/podcast/episodes/{episode}', 'EpisodeController@destroy')->name('episodes.destroy');
