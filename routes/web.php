<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware'=>['myweb:GET','web']], function(){

    Route::get('/', 'sallerController@HomePage');
    Route::get('/sales_team', 'sallerController@HomePage');
    Route::get('/saller_home_data', 'sallerController@HomeData');
    Route::get('/saller_new', 'sallerController@New');
    Route::get('/saller_edit', 'sallerController@Edit');

});

Route::group(['middleware'=>['myweb:POST','web']], function(){

    Route::post('/saller_details', 'sallerController@Preview');
    Route::post('/saller_name_validate', 'sallerController@name_validate');
    Route::post('/saller_save', 'sallerController@save');

});




