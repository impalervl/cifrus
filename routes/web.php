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
    return view('information');
});

Route::get('/infuse', 'InformationController@infuse');

Route::get('/request', 'InformationController@getInformation');

Route::post('/request/officiants', 'InformationController@getOfficiants');

Route::post('/request/profit', 'InformationController@getProfit');

Route::post('/request/meals', 'InformationController@getMeals');

Route::post('/request/orders', 'InformationController@getOrders');