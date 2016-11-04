const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

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

elixir(mix => {
    mix.sass('app.scss')
    .webpack('app.js');
    //.browserify('app.js');

	   mix.scripts([
	    
	        'jquery-1.9.1.min.js',
	        'manager.js'
			],
			'./public/js/vasil.js'
			
		);
	    
	   mix.version("css/app.css");
});


