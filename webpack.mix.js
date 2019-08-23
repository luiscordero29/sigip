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

//mix.js('resources/js/app.js', 'public/js')
//   .sass('resources/sass/app.scss', 'public/css');
mix.styles([
   'node_modules/admin-lte/dist/css/adminlte.css',
   'node_modules/@fortawesome/fontawesome-free/css/all.css'
], 'public/css/all.css');
mix.copy('node_modules/admin-lte/plugins/jquery/jquery.min.js', 'public/js');
mix.copy('node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js', 'public/js');
mix.copy('node_modules/admin-lte/plugins/fastclick/fastclick.js', 'public/js');
mix.copy('node_modules/admin-lte/dist/js/adminlte.js', 'public/js');
mix.copy('node_modules/admin-lte/dist/js/demo.js', 'public/js');
mix.copyDirectory('node_modules/admin-lte/dist/img', 'public/img');
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');