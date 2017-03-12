<?php

Route::group(['as' => 'codeeduuser.', 'middleware' =>
    ['auth', config('codeeduuser.middleware.isVerified')]], function () {

    Route::group(['prefix' => 'admin', 'middleware' => 'auth.resource'], function () {
        Route::resource('users', 'UsersController');
        Route::resource('roles', 'RolesController');
        Route::get('roles/{role}/permissions', 'RolesController@editPermission')->name('roles.permission.edit');
        Route::put('roles/{role}/permissions', 'RolesController@updatePermission')->name('roles.permission.update');
    });

    Route::get('users/profile', 'UserSettingsController@profile')->name('user_settings.profile');

    Route::get('users/settings', 'UserSettingsController@edit')->name('user_settings.edit');
    Route::put('users/settings', 'UserSettingsController@update')->name('user_settings.update');

    Route::get('email-verification/error', 'UserConfirmationController@getVerificationError')->name('email-verification.error');
    Route::get('email-verification/check/{token}', 'UserConfirmationController@getVerification')->name('email-verification.check');

});

