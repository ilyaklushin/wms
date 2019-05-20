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
    return view('main');
});

Route::resource('products', 'ProductController');
Route::resource('units', 'UnitController');
Route::resource('exchange-history', 'ExchangeHistoryController');
Route::resource('exchange-settings', 'ExchangeSettingsController');