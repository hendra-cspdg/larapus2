<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function(){
	return '<h1>Halo</h1>
			Selamat datang di webapp saya <br>
			Laravel, emang keren.';
});

Route::get('/testModel',function(){
	$query = App\Post::find(1);
	return $query;
});
