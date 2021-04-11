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
    .js('resources/assets/js/forms/delete.js', 'public/js/forms')
    .js('resources/assets/js/privacy-policy/fetchContent.js', 'public/js/privacy-policy')
    .js('resources/assets/js/posts/orderBy.js', 'public/js/posts')
    .js('resources/assets/js/pagination/pagination.js', 'public/js/pagination')
    sass('resources/assets/sass/app.scss', 'public/css');
