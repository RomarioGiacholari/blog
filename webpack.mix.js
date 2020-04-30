let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/coffee/updateAmount.js', 'public/js/coffee')
   .js('resources/assets/js/photos/refreshPhoto.js', 'public/js/photos')
   .js('resources/assets/js/photos/fetchPhotos.js', 'public/js/photos')
   .sass('resources/assets/sass/app.scss', 'public/css');
