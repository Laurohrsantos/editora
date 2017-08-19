<?php

Route::group(['middleware' => ['auth', config('codeeduuser.middleware.isVerified'), 'auth.resource']], function () {
    Route::resource('categories', 'CategoriesController');
    Route::group(['prefix' => 'books/{book}'], function () {
        Route::resource('chapters', 'ChapterController');
    });
    Route::resource('books', 'BooksController');
    Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function () {
        Route::resource('books', 'BooksTrashedController', ['except' => ['create', 'store', 'edit', 'destroy']]);
    });
});
