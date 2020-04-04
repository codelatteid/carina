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

Route::get('/', 'mainController@index')->name('home');

// Routes Shell
Route::get('/shell', 'shellController@shellindex')->name('shell');
Route::get('/shell/new', 'shellController@shellinput');
Route::get('/shell/source', 'shellController@shellsource');
Route::post('/shell/new', 'shellController@shellinputpost');
Route::post('/shell/delete', 'shellController@shelldelete');
Route::get('/shell/detail/{id}', 'shellController@shellview');
Route::post('/shell/detail/{id}', 'shellController@shellupdate');
Route::post('/shell/check', 'shellController@shellcheckjq')->name('shell_cekjq');

// Routes VPS
Route::get('/vps', 'vpsController@vpsindex')->name('vps');
Route::get('/vps/new', 'vpsController@vpsinput');
Route::post('/vps/new', 'vpsController@vpsinputpost');
Route::post('/vps/delete', 'vpsController@vpsdelete');
Route::get('/vps/detail/{id}', 'vpsController@vpsview');
Route::post('/vps/detail/{id}', 'vpsController@vpsupdate');

// Routes cPanels
Route::get('/cpanel', 'cpanelController@cpanelindex')->name('cpanel');
Route::get('/cpanel/new', 'cpanelController@cpanelinput');
Route::post('/cpanel/new', 'cpanelController@cpanelinputpost');
Route::post('/cpanel/delete', 'cpanelController@cpaneldelete');
Route::get('/cpanel/detail/{id}', 'cpanelController@cpanelview');
Route::post('/cpanel/detail/{id}', 'cpanelController@cpanelupdate');