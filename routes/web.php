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

Route::get('/', 'LandingController@index')->name('home');
Route::post('/send', 'LandingController@sendEmail')->name('send.email');
Route::post('/call_back', 'LandingController@callBack')->name('call.back');
//Route::get('/utm=content_{utm}', 'LandingController@utmTitle')->name('utm.title');
//Route::get('/?utm_content={utm}', 'LandingController@utmTitle')->name('utm.title');
//Route::post('/', 'LandingController@cookie')->name('cookie');

Auth::routes();

Route::get('/home', 'HomeController@index');

//block
Route::get('/menu', 'MenuController@index');

Route::post('/lead', 'LandingController@lead')->name('lead');
