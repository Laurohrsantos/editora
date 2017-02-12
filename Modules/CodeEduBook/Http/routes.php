<?php

Route::group(['middleware' => 'auth'], function (){
    Route::resource('books', 'BooksController');
    Route::resource('categories', 'CategoriesController');
    Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function () {
        Route::resource('books', 'BooksTrashedController', ['except' => ['create', 'store','edit', 'destroy']]);
    });
});
