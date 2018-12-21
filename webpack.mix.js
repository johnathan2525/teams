const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .extract()
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .browserSync(process.env.APP_URL)

if (mix.inProduction()) {
    mix.version();
}


