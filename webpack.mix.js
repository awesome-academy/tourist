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
    .sass('resources/sass/app.scss', 'public/css/app.css');
mix.copyDirectory('resources/images', 'public/images/');
mix.copyDirectory('resources/uploads', 'public/uploads/');
