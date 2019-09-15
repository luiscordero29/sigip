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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/region', 'RegionController@index');
Route::get('/region/json', 'RegionController@json');
Route::get('/region/create', 'RegionController@create');
Route::post('/region/store', 'RegionController@store');
Route::get('/region/show/{id}', 'RegionController@show');
Route::get('/region/edit/{id}', 'RegionController@edit');
Route::put('/region/update/{id}', 'RegionController@update');
Route::delete('/region/destroy/{id}', 'RegionController@destroy');
