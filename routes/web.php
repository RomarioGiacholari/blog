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
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/all-photos', 'PhotoController@index');
Route::resource('posts', 'PostController');
