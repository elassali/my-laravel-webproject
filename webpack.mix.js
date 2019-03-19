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

mix.js('resources/js/app.js','public/js')
   .js('resources/js/multi_f_movie.js','public/js')
   .js('resources/js/multi_f_episode.js','public/js')
   .js('resources/js/select_plugin.js','public/js') 
   .sass('resources/sass/app.scss','public/css');


   mix.styles([
     'resources/css/bootstrap.min.css',
     'resources/css/bootstrap-theme.css',
     'resources/css/elegant-icons-style.css',
     'resources/css/font-awesome.min.css',
     'resources/css/bootstrap-multiselect.css',
     'resources/css/style.css',
   ],'public/css/libs.css');

   mix.scripts([
     'resources/js/jquery.js',
     'resources/js/bootstrap.min.js',
     'resources/js/bootstrap-multiselect.js',
     'resources/js/jquery.nicescroll.js',
     'resources/js/scripts.js',
   ],'public/js/libs.js');