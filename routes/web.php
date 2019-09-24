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
# Mantenedor de Regiones
Route::get('/region', 'RegionController@index');
Route::get('/region/json', 'RegionController@json');
Route::get('/region/create', 'RegionController@create');
Route::post('/region/store', 'RegionController@store');
Route::get('/region/show/{id}', 'RegionController@show');
Route::get('/region/edit/{id}', 'RegionController@edit');
Route::put('/region/update/{id}', 'RegionController@update');
Route::delete('/region/destroy/{id}', 'RegionController@destroy');
# Mantenedor de Provincias
Route::get('/province', 'ProvinceController@index');
Route::get('/province/json', 'ProvinceController@json');
Route::get('/province/create', 'ProvinceController@create');
Route::post('/province/store', 'ProvinceController@store');
Route::get('/province/show/{id}', 'ProvinceController@show');
Route::get('/province/edit/{id}', 'ProvinceController@edit');
Route::put('/province/update/{id}', 'ProvinceController@update');
Route::delete('/province/destroy/{id}', 'ProvinceController@destroy');
Route::get('/province/getRegionById/{id}', 'ProvinceController@getRegionById');
# Mantenedor de Distritos
Route::get('/district', 'DistrictController@index');
Route::get('/district/json', 'DistrictController@json');
Route::get('/district/create', 'DistrictController@create');
Route::post('/district/store', 'DistrictController@store');
Route::get('/district/show/{id}', 'DistrictController@show');
Route::get('/district/edit/{id}', 'DistrictController@edit');
Route::put('/district/update/{id}', 'DistrictController@update');
Route::delete('/district/destroy/{id}', 'DistrictController@destroy');