<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/', 'LoginController@index');
    Route::post('/auth', 'LoginController@authenticate')->name('auth.login');
    Route::get('/logout', 'LoginController@logout')->name('auth.logout');

});

Route::group(['middleware' => 'web', 'namespace' => 'App\Http\Controllers\Auth'], function()
{
    Route::get('/password/email', 'ResetPasswordController@showView');
    Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('send.email');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('reset.password');
});



Route::group(['middleware' => ['web', 'auth'], 'prefix'=> 'profile', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/me', 'ProfileController@index');
    Route::put('/me', 'ProfileController@store')->name('profile.update');


});

Route::group(['middleware' => ['web', 'auth', 'role:view-users,Admin,Invitado,Moderador'], 'prefix' => 'users', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{

    Route::get('/', 'UsersController@index');
    Route::get('/create', 'UsersController@create');
    Route::post('/create', 'UsersController@store')->name('user.create');
    Route::get('/edit/{id}', 'UsersController@edit');
    Route::put('/update/{id}', 'UsersController@update')->name('user.update');
    Route::post('/delete/{id}', 'UsersController@destroy');


});

Route::group(['middleware' => ['web', 'auth', 'role:view-roles,Admin,Invitado,Moderador'], 'prefix' => 'role', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/', 'RoleController@index')->name('role');
    Route::get('/create', 'RoleController@create');
    Route::post('/create', 'RoleController@store')->name('role.create');
    Route::get('/edit/{id}', 'RoleController@edit');
    Route::post('/update/{id}', 'RoleController@update')->name('role.update');
    Route::post('/delete/{id}', 'RoleController@destroy');
});

Route::group(['middleware' => ['web', 'auth', 'role:view-permissions,Admin,Invitado,Moderador'], 'prefix' => 'permission', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/', 'PermissionController@index');
    Route::get('/create', 'PermissionController@create');
    Route::post('/create', 'PermissionController@store')->name('permission.create');
    Route::get('/edit/{id}', 'PermissionController@edit');
    Route::post('/update/{id}', 'PermissionController@update')->name('permission.update');
    Route::post('/delete/{id}', 'PermissionController@destroy');
});
