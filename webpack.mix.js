const { mix } = require('laravel-mix');

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

mix
    .copy('resources/assets/img', 'public/images')
    .js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles([
        // 'node_modules/propellerkit/dist/css/propeller.css',
        'resources/assets/css/sb-admin-2.css',
        'resources/assets/css/dataTables.bootstrap.css',
        'resources/assets/css/dataTables.responsive.css',
    ], 'public/css/custom.css')
    .scripts([
           'resources/assets/js/sb-admin-2.js',
    ], 'public/js/custom.js');

mix
    .sass('resources/assets/sass/invoice.scss', 'public/css/invoice.css');
