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


Route::get('/', 'PhotoController@index');
Route::get('/show/{status?}', 'PhotoController@show');
Route::get('/controls/{photo}', 'PhotoController@controls');
Route::get('/edit', 'PhotoController@edit');
Route::post('/store', 'PhotoController@store');
Route::delete('/destroy/{photo}', 'PhotoController@destroy');
Route::patch('/restore/{photo}', 'PhotoController@restore');
Route::get('/download/{photo}', 'PhotoController@download');