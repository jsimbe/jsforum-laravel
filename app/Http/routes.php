<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PostController@index');

Route::get('home', ['as' => 'home', 'uses' => 'PostController@index']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => ['auth']], function()
{
  Route::get('new-post', 'PostController@create');
  Route::post('new-post', 'PostController@store');
  Route::get('edit/{slug}', 'PostController@edit');
  Route::post('update', 'PostController@update');
  Route::get('delete/{id}', 'PostController@destroy');

  Route::get('my-all-posts', 'UserController@user_posts_all');
  Route::get('my-drafts', 'UserController@user_posts_draft');

  Route::post('comment/add', 'CommentController@store');
  Route::delete('commend/delete/{id}', 'CommentController@destroy');

});

Route::get('/{slug}', ['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');
