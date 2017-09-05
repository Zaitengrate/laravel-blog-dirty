<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])
    ->where('slug', '[\w\d\-\_]+');
Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);

Route::get('contact', 'PagesController@getContact');
Route::post('contact', 'PagesController@postContact');
Route::get('about', 'PagesController@getAbout');
Route::get('/', 'PagesController@getIndex');

Route::resource('posts', 'PostController');

Auth::routes();
Route::get('/logout','Auth\LoginController@logout' );

Route::get('/home', 'HomeController@index')->name('home');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::resource('categories', 'CategoryController', ['except' => ['create']]);

Route::resource('tags', 'TagController', ['except' => ['create']]);

//Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
Route::post('comments/{post_id}', 'CommentsController@store')->name('comments.store');
Route::get('comments/{id}/edit', 'CommentsController@edit')->name('comments.edit');
Route::put('comments/{id}', 'CommentsController@update')->name('comments.update');
Route::delete('comments/{id}', 'CommentsController@destroy')->name('comments.destroy');
Route::get('comments/{id}/delete', 'CommentsController@delete')->name('comments.delete');