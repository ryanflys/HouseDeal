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

// 前台路由
Route::get('/', 'HouseController@index')->name('home');
Route::get('/houses', 'HouseController@index')->name('houses.index');
Route::get('/houses/{id}', 'HouseController@show')->name('houses.show');

// 认证路由
Auth::routes();

// 前台用户路由（需登录）
Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', 'UserController@dashboard')->name('user.dashboard');
    Route::get('/user/houses', 'UserController@myHouses')->name('user.houses');
    Route::get('/user/favorites', 'UserController@favorites')->name('user.favorites');
    Route::post('/user/favorites/{id}', 'UserController@toggleFavorite')->name('user.favorites.toggle');
    Route::resource('user/houses', 'HouseController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
});

// 后台管理路由（需登录 + 管理员权限）
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin'], 'namespace' => 'Admin'], function () {
    Route::get('index', 'IndexController@index')->name('admin.index');
    Route::resource('houses', 'HouseController');
    Route::resource('users', 'UserController');
    Route::resource('agents', 'AgentController');
    Route::resource('deals', 'DealController');
});
