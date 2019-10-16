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

mix.js('resources/js/app.js', 'public/js')
    // .scripts([
    //     'assets/js/core/bootstrap-material-design.min.js',
    //     'assets/js/plugins/moment.min.js',
    //     'assets/js/plugins/bootstrap-datetimepicker.js',
    //     'assets/js/plugins/nouislider.min.js',
    //     'assets/js/material-kit.js?v=2.0.6',
    // ], 'public/js/all.js')
    // .styles([
    //     'assets/css/material-kit.css?v=2.0.6',
    //     'assets/demo/demo.css'
    // ], 'public/css/all.css')
   .sass('resources/sass/app.scss', 'public/css');

