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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(); 
// Authentication Routes...
/* Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');
 */
Route::get('/logout', 'Auth\LoginController@logout');

//Client Side
Route::get('/homeClient', 'HomeController@homeclient')->name('homeClient');
Route::get('/wallet', 'HomeController@wallet')->name('wallet');

//Admin Side
Route::group(['middleware' => 'auth'], function()
{
    //All the routes that belongs to the group goes here
   // Route::post('/login', 'HomeController@logout')->name('logout');
   /* Route::get('/homeClient', 'Auth\AuthController@homeClient'); */
    Route::get('/profile', 'HomeController@profile')->name('profile');
    Route::get('/userManage', 'HomeController@usermanage')->name('userManage');
    Route::get('/homeAdmin', 'HomeController@index')->name('homeAdmin');
     Route::get('/homeAdmin', 'HomeController@edit')->name('homeAdmin');
    /*Route::get('/homeAdmin', 'HomeController@update')->name('homeAdmin'); */
});

