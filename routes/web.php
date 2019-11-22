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

// Authentication Routes...
Auth::routes(); 
Route::get('/logout', 'Auth\LoginController@logout');

/* Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout'); */

//Route::post('login', 'Auth\LoginController@redirectTo');

/*Routes for displaying admin and client side crypto coins lists*/ 
Route::get('/homeClient', 'HomeController@homeclient')->name('homeClient');
Route::get('/homeAdmin', 'HomeController@homeadmin')->name('homeAdmin'); 

/*Client Side*/
Route::get('/wallet', 'HomeController@wallet')->name('wallet');
Route::get('/buyCryptos', 'BuyController@buyCryptos')->name('buyCryptos');
Route::post('/buyCryptosAction', 'HomeController@buy')->name('buy');
Route::get('/sellCryptos', 'SellController@sellCryptos')->name('sellCryptos');
Route::post('/sellCryptosAction', 'HomeController@sell')->name('sell');

/*Admin Side*/
Route::group(['middleware' => 'auth'], function()
{
//Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/userManage', 'HomeController@usermanage')->name('userManage'); 
Route::get('/profile', 'HomeController@profile')->name('profile'); 
});
/*Route for admin-side user management with ressource*/
Route::resource('/userManage', 'UserAdminController');
//Route::resource('/profile', 'AdminProfileController'); 
//Route::resource('/homeClient', 'UserClientController');