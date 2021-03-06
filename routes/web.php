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
//latihan Controller
Route::get('/about', 'MyController@showAbout');
Route::get('/testModel',function(){
	$post = new App\Post;
	$post->title = 'Cepat Mahir Coding';
	$post->content = 'Coding everyday,understanding the pattern';
	$post->save();
	return $post;
});

Route::get('/','GuestController@index');

Auth::routes();
Route::get('auth/verify/{token}', 'Auth\RegisterController@verify');
Route::get('auth/send-verification', 'Auth\RegisterController@sendVerification');

Route::get('/home', 'HomeController@index');
Route::get('settings/profile','SettingsController@profile');
Route::get('settings/profile/edit','SettingsController@editProfile');
Route::post('settings/profile','SettingsController@updateProfile');
Route::get('settings/password','SettingsController@editPassword');
Route::post('settings/password','SettingsController@updatePassword');


Route::group(['prefix'=>'admin','middleware'=>['auth','role:admin']],function(){
  Route::resource('authors','AuthorsController');
  Route::resource('books','BooksController');
  Route::resource('members','MembersController');

  Route::get('statistics', [
    'as' => 'statistics.index',
    'uses' => 'StatisticsController@index'
  ]);

  Route::get('export/books',[
    'as' => 'export.books',
    'uses' => 'BooksController@export',
  ]);

  Route::post('export/books',[
    'as' => 'export.books.post',
    'uses' => 'BooksController@exportPost',
  ]);

  Route::get('template/books',[
    'as' => 'template.books',
    'uses' => 'BooksController@generateExcelTemplate'
  ]);
  Route::post('import/books',[
    'as' => 'import.books',
    'uses' => 'BooksController@importExcel'
  ]);
});

Route::get('books/{book}/borrow', [
  'middleware' => ['auth', 'role:member'],
  'as'         => 'guest.books.borrow',
  'uses'       => 'BooksController@borrow'
]);
Route::put('books/{book}/return', [
  'middleware' => ['auth', 'role:member'],
  'as'         => 'member.books.return',
  'uses'       => 'BooksController@returnBack'
]);
