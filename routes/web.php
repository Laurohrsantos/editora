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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function (){
    Route::resource('books', 'BooksController');
    Route::resource('categories', 'CategoriesController');
    Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function () {
        Route::resource('books', 'BooksTrashedController', ['except' => ['show', 'create', 'store','edit', 'update', 'destroy']]);
    });
});
