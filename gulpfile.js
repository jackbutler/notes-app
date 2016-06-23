var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
});

elixir(function(mix) {
    mix.copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js', 'resources/assets/js/bootstrap.min.js')
        .scripts(['bootstrap.min.js','validator.min.js','site.js']);
});