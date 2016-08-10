<?php


Route::get('/', function () {
    return view('welcome');
});

// Route::auth();

/**
 * Auth Routes - Start
 */
Route::get('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@showLoginForm']);
Route::post('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@login']);
Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@logout']);

// Registration Routes...
Route::get('register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@showRegistrationForm']);
Route::post('register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@register']);

// Password Reset Routes...
Route::get('password/reset/{token?}', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@showResetForm']);
Route::post('password/email', ['as' => 'auth.password.email', 'uses' => 'Auth\PasswordController@sendResetLinkEmail']);
Route::post('password/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@reset']);
/**
 * Auth Routes - End
 */

Route::resource('backend/permissions', 'Backend\PermissionController');

Route::get( 'backend/roles', [ 'as' => 'backend.roles.index', 'uses' => 'Backend\RoleController@index', 'middleware' => ['permission:role-list|role-create|role-edit|role-delete']] );

Route::get( 'backend/roles/create', [ 'as' => 'backend.roles.create', 'uses' => 'Backend\RoleController@create', 'middleware' => ['permission:role-create' ]] );

Route::post( 'backend/roles/create', [ 'as' => 'backend.roles.store', 'uses' => 'Backend\RoleController@store'] );

Route::get( 'backend/roles/{id}', [ 'as' => 'backend.roles.show', 'uses' => 'Backend\RoleController@show' ] );

Route::get( 'backend/roles/{id}/edit', [ 'as' => 'backend.roles.edit', 'uses' => 'Backend\RoleController@edit'] );

Route::put( 'backend/roles/{id}', [ 'as' => 'backend.roles.update', 'uses' => 'Backend\RoleController@update'] );

Route::delete( 'backend/roles/{id}', [ 'as' => 'backend.roles.destroy', 'uses' => 'Backend\RoleController@destroy' ] );


Route::get( 'backend/users/{users}/confirm', ['as' => 'backend.users.confirm', 'uses' => 'Backend\UsersController@confirm'] );
Route::resource('backend/users', 'Backend\UsersController');

Route::get( 'backend/posts/{post}/confirm', ['as' => 'backend.posts.confirm', 'uses' => 'Backend\PostsController@confirm'] );
Route::resource('backend/posts', 'Backend\PostsController');

Route::get('backend/dashboard', ['as' => 'backend.dashboard', 'uses' => 'Backend\DashboardController@index']);

Route::get('/home', 'HomeController@index');
