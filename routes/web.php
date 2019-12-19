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
});

Route::get('/resume', function () {
    $pathToFile = public_path('resume.pdf');
    
    return response()->file($pathToFile);
})->name('resume');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/all-photos', 'PhotoController@index')->name('photos');
Route::get('/all-photos/{identifier}', 'PhotoController@show')->name('photos.show');
Route::resource('posts', 'PostController');

Route::get('/contact', 'ContactController@create')->name('contact.create');
Route::post('/contact', 'ContactController@store')->name('contact.store');

Route::get('/privacy-policy', 'PrivacyPolicyController@index')->name('privacy-policy.index');