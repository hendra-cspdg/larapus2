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
Route::group(['prefix'=>'admin','middleware'=>['auth']],function(){
  Route::resource('authors','AuthorsController');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', 'MyController@showAbout');

Route::get('/testModel',function(){
	$post = new App\Post;
	$post->title = 'Cepat Mahir Coding';
	$post->content = 'Coding everyday,understanding the pattern';
	$post->save();

	return $post;
});

Auth::routes();

Route::get('/home', 'HomeController@index');
