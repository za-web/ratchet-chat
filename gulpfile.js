var elixir = require('laravel-elixir');

/*
 |----------------------------------------------------------------
 | Have a Drink
 |----------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic
 | Gulp tasks for your Laravel application. Elixir supports
 | several common CSS, JavaScript and even testing tools!
 |
 */

elixir(function (mix) {
    // mix.sass('app.scss');\
    mix.styles([
        "main.css",
        "chat.css"
    ], 'public/build/css/all.css', 'public/css')

        .copy(
        'vendor/bower_components/handlebars/handlebars.min.js',
        'public/js/handlebars.min.js'
    )

      .copy(
        'vendor/bower_components/jquery/dist/jquery.min.js',
        'public/js/jquery.min.js'
    )
     .copy(
        'vendor/bower_components/jquery/dist/jquery.min.map',
        'public/js/jquery.min.map'
    )
        .copy(
        'vendor/bower_components/bootstrap/dist/js/bootstrap.min.js',
        'public/js/bootstrap.min.js'
    )
        .copy(
        'vendor/bower_components/bootstrap/dist/css/bootstrap.min.css',
        'public/css/bootstrap.min.css'
    )
        .copy(
        'vendor/bower_components/bootstrap/dist/css/bootstrap-theme.min.css',
        'public/css/bootstrap-theme.min.css'
    )
        .copy(
        'vendor/bower_components/bootstrap/dist/fonts',
        'public/fonts'
    )
        .copy(
        'vendor/bower_components/font-awesome/css/font-awesome.min.css',
        'public/css/font-awesome.min.css'
    )
        .copy(
        'vendor/bower_components/font-awesome/fonts',
        'public/css/fonts'
    )
});
