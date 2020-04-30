<?php

Route::get('/', function () {
    $viewModel = new stdClass;
    $viewModel->pageTitle = 'Welcome';
    $viewModel->testimonials = [
        'Ermir Hasanbelliu' => [
            'imageUrl' => 'https://media-exp1.licdn.com/dms/image/C4D03AQE2G-PN3ojdew/profile-displayphoto-shrink_200_200/0?e=1593648000&v=beta&t=jjdXzXKVjhXcmHpwbHwkC-Lzd10ZL7FcT0IxrY0wDJM',
            'testimonial' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            'link' => 'https://www.linkedin.com/in/ermir-hasanbelliu-a4865a130/'
        ],
        'Artiol Kouloli' => [
            'imageUrl' => 'https://media-exp1.licdn.com/dms/image/C4D03AQHkSPMIMtOftg/profile-displayphoto-shrink_200_200/0?e=1593648000&v=beta&t=_lKLcCphHtZAkrBI-gPsPGC-1SzIpPr6f44tZd1Xu-M',
            'testimonial' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            'link' => 'https://www.linkedin.com/in/artiol-kouloli-15716515b/'
        ],
        'Dmitrijs Vasilcenko' => [
            'imageUrl' => 'https://media-exp1.licdn.com/dms/image/C4D03AQGSH8UzopGGLg/profile-displayphoto-shrink_200_200/0?e=1593648000&v=beta&t=pTQHli8_VIHii6Z6372zN2QVceYia-leJxrfqqGerag',
            'testimonial' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            'link' => 'https://www.linkedin.com/in/vasilced/'
        ],
        'Emil Odagiu' => [
            'imageUrl' => 'https://media-exp1.licdn.com/dms/image/C5603AQFAZHiBk_51iA/profile-displayphoto-shrink_200_200/0?e=1593648000&v=beta&t=wq3Xt4kbizxiUjoZvoFNdKEUlgkhyHF4OebQpVadB5I',
            'testimonial' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            'link' => 'https://www.linkedin.com/in/emil-odagiu/'
        ],
        'Mario Ramic' => [
            'imageUrl' => 'https://media-exp1.licdn.com/dms/image/C4D03AQF0X2USgdvvJA/profile-displayphoto-shrink_200_200/0?e=1593648000&v=beta&t=W6IptkGOtv22pMrJXTNrHMfiKQ9BnvO9Ppg5mnudcZg',
            'testimonial' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            'link' => 'https://www.linkedin.com/in/mario-rami%C4%87-1a9642142/'
        ]
    ];

    return view('welcome', ['viewModel' => $viewModel]);
})->name('welcome');

Route::get('/resume', function () {
    $pathToFile = public_path('resume.pdf');
    
    return response()->file($pathToFile);
})->name('resume');

Route::get('/coffee', 'CoffeeController@index')->name('coffee.index');
Route::post('/coffee', 'CoffeeController@store')->name('coffee.store');
Route::get('/coffee/confirm/{sessionId}', 'CoffeeController@confirm')->name('coffee.confirm');
Route::get('/coffee/success', 'CoffeeController@success')->name('coffee.success');
Route::get('/coffee/cancel', 'CoffeeController@cancel')->name('coffee.cancel');

Auth::routes();

Route::get('/home/posts', 'HomeController@posts')->name('home.posts');
Route::get('/home/episodes', 'HomeController@episodes')->name('home.episodes');

Route::get('/all-photos', 'PhotoController@index')->name('photos');
Route::get('/all-photos/partial', 'PhotoController@photos')->name('photos.partial');
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

Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

Route::prefix('/api')->group(function () {
    Route::get('/projects', 'ProjectApiController@index')->name('api.projects.index');
    Route::get('/photos', 'PhotoApiController@index')->name('api.photos.index');
});
