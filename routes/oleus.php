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
    return view('oleus.layouts.admin');
});
//Route::post('/callback', 'LandingController@callback');

//block
Route::get('/block', 'BlocksController@index')->name('block.index');
Route::get('/block/show/{block}', 'BlocksController@show')->name('block.show');
Route::get('/block/create', 'BlocksController@create')->name('block.create');
Route::post('/block/create', 'BlocksController@store')->name('block.store');
Route::get('/block/edit/{block}', 'BlocksController@edit')->name('block.edit');
Route::post('/block/edit/{block}', 'BlocksController@update')->name('block.update');
Route::get('/block/destroy/{block}', 'BlocksController@destroy')->name('block.destroy');
Route::get('/block/change_status', 'BlocksController@sort')->name('block.sort');

//static text
Route::get('/text', 'BlocksController@indexText')->name('text.index');
Route::get('/text/create', 'BlocksController@createText')->name('text.create');
Route::post('/text/create', 'BlocksController@storeText')->name('text.store');
Route::get('/test/edit/{text}', 'BlocksController@editText')->name('text.edit');
Route::post('/test/edit/{text}', 'BlocksController@updateText')->name('text.update');
Route::get('/test/destroy/{text}', 'BlocksController@destroyText')->name('text.destroy');

//lead
Route::get('/lead', 'LeadsController@index')->name('lead.index');
Route::get('/lead/show/{lead}', 'LeadsController@show')->name('lead.show');

//setting
Route::get('/setting', 'SettingsController@index');
Route::post('/setting', 'SettingsController@update')->name('setting.update');

//contacts
Route::get('/contact', 'ContactsController@index')->name('contact.index');
Route::post('/contact', 'ContactsController@update')->name('contact.update');

//menu
Route::get('/menu', 'MenuController@index')->name('menu.index');
Route::get('/menu/create', 'MenuController@create')->name('menu.create');
Route::post('/menu/create', 'MenuController@store')->name('menu.store');
Route::get('/menu/edit/{menu}', 'MenuController@edit')->name('menu.edit');
Route::post('/menu/edit/{menu}', 'MenuController@update')->name('menu.update');
Route::get('/menu/destroy/{menu}', 'MenuController@destroy')->name('menu.destroy');
Route::get('/menu/change_status', 'MenuController@sort')->name('menu.sort');

//form
Route::get('/form', 'FormsController@index')->name('form.index');
Route::get('/form/show/{form}', 'FormsController@show')->name('form.show');
Route::get('/form/create', 'FormsController@create')->name('form.create');
Route::post('/form/create', 'FormsController@store')->name('form.store');
Route::get('/form/edit/{form}', 'FormsController@edit')->name('form.edit');
Route::post('/form/edit/{form}', 'FormsController@update')->name('form.update');
Route::get('/form/destroy/{form}', 'FormsController@destroy')->name('form.destroy');
Route::get('/form/del/{form}/{field}', 'FormsController@del_field')->name('form.del.field');

//field
Route::get('/field', 'FieldsController@index')->name('field.index');
Route::get('/field/create', 'FieldsController@create')->name('field.create');
Route::post('/field/create', 'FieldsController@store')->name('field.store');
Route::get('/field/edit/{field}', 'FieldsController@edit')->name('field.edit');
Route::post('/field/edit/{field}', 'FieldsController@update')->name('field.update');
Route::get('/field/destroy/{field}', 'FieldsController@destroy')->name('field.destroy');
Route::get('/field/change_status', 'FieldsController@sort')->name('field.sort');

//review
Route::get('/review', 'ReviewsController@index')->name('review.index');
Route::get('/review/show/{review}', 'ReviewsController@show')->name('review.show');
Route::get('/review/create', 'ReviewsController@create')->name('review.create');
Route::post('/review/create', 'ReviewsController@store')->name('review.store');
Route::get('/review/edit/{review}', 'ReviewsController@edit')->name('review.edit');
Route::post('/review/edit/{review}', 'ReviewsController@update')->name('review.update');
Route::get('/review/destroy/{review}', 'ReviewsController@destroy')->name('review.destroy');
Route::get('/review/change_status', 'ReviewsController@sort')->name('review.sort');

//advantage
Route::get('/advantage', 'AdvantagesController@index')->name('advantage.index');
Route::get('/advantage/show/{advantage}', 'AdvantagesController@show')->name('advantage.show');
Route::get('/advantage/create', 'AdvantagesController@create')->name('advantage.create');
Route::post('/advantage/create', 'AdvantagesController@store')->name('advantage.store');
Route::get('/advantage/edit/{advantage}', 'AdvantagesController@edit')->name('advantage.edit');
Route::post('/advantage/edit/{advantage}', 'AdvantagesController@update')->name('advantage.update');
Route::get('/advantage/destroy/{advantage}', 'AdvantagesController@destroy')->name('advantage.destroy');
Route::get('/advantage/change_status', 'AdvantagesController@sort')->name('advantage.sort');


//title
Route::get('/title', 'TitlesController@index')->name('title.index');
Route::get('/title/edit/{title}', 'TitlesController@edit')->name('title.edit');
Route::post('/title/edit/{title}', 'TitlesController@update')->name('title.update');
Route::get('/title/show/{title}', 'TitlesController@show')->name('title.show');
Route::get('/title/create', 'TitlesController@create')->name('title.create');
Route::post('/title/create', 'TitlesController@store')->name('title.store');
Route::get('/title/destroy/{title}', 'TitlesController@destroy')->name('title.destroy');
Route::get('/title/change_status', 'TitlesController@sort')->name('title.sort');


//statistic
Route::get('/statistic', 'StatisticController@index');