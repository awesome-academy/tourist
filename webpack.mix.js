const mix = require('laravel-mix');

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

mix.copyDirectory('resources/assets/js/index.js', 'public/assets/js/index.js')
    .copyDirectory('resources/assets/js/menu.js', 'public/assets/js/menu.js')
    .copyDirectory('resources/assets/js/frontend.js', 'public/assets/js/frontend.js')
    .copyDirectory('resources/assets/js/tour.js', 'public/assets/js/tour.js')
    .copyDirectory('resources/assets/js/review.js', 'public/assets/js/review.js')
    .sass('resources/sass/app.scss', 'public/css/app.css');
mix.copyDirectory('resources/images', 'public/images/');
mix.copyDirectory('resources/uploads', 'public/uploads/');