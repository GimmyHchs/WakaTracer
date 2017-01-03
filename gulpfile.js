const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

//Semantic
require('./semantic/gulpfile.js');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
  mix.styles('/../../../semantic/dist/semantic.min.css','public/css/semantic.min.css');
  mix.webpack('/../../../semantic/dist/semantic.min.js','public/js/semantic.min.js');
    mix.sass('app.scss')
       .webpack('app.js');
    mix.sass('login.scss','public/css/login.css');
});
