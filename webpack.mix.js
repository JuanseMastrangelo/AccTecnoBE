const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/plugins/datatable.js', 'public/js/plugins')
    .sass('resources/sass/app.scss', 'public/css');

mix.browserSync('127.0.0.1:8000');