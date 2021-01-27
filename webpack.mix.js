const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
/*
mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);
*/
mix.js('node_modules/jquery/dist/jquery.js', 'public/js/jquery.js')
    .js('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/js/bootstrap.js')
    .postCss('node_modules/bootstrap/dist/css/bootstrap.css', 'public/css/bootstrap.css');

mix.js('resources/js/app.js', 'public/js/app.js')
    .vue()
    .postCss('resources/css/app.css', 'public/css/app.css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .version();
