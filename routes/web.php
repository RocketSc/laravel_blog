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

//Authentication Routes
Auth::routes();
Route::get('/home', 'HomeController@index');


Route::get('/contact', 'PagesController@getContact');
Route::post('/contact', 'PagesController@postContact')->name('contact.send');

Route::get('/about', 'PagesController@getAbout');
Route::get('/', 'PagesController@getIndex');

Route::get('/blog/{slug}', 'BlogController@getSingle')
    ->where('slug', '[\w\d\_]+')
    ->name('blog.single');

Route::get('/blog', 'BlogController@index')->name('blog.index');

Route::resource('/posts','PostsController');
Route::resource('/categories', 'CategoryController', ['except' => ['create']]);
Route::resource('/tags', 'TagsController', ['except' => ['create']]);


//Comments routes
Route::post('comment/{post}', 'CommentsController@store')
     ->name('comment.store');

Route::get('comment/{comment}/edit', 'CommentsController@edit')
    ->name('comment.edit');

Route::put('comment/{comment}', 'CommentsController@update')
    ->name('comment.update');

Route::delete('comment/{comment}', 'CommentsController@destroy')
    ->name('comment.destroy');


