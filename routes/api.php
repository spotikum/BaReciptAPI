<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('resep','apicontroller@ambil_semua_resep')->middleware('jwtAuth');
// Route::get('resep/{id}','apicontroller@ambil_satu_resep')->middleware('jwtAuth');
// Route::post('resep/tambah_resep','apicontroller@insert_data_resep')->middleware('jwtAuth');
// Route::put('resep/update/{id}', 'apicontroller@update_data_resep')->middleware('jwtAuth');
// Route::delete('resep/delete/{id}', 'apicontroller@delete_data_resep')->middleware('jwtAuth');

Route::get('resep','apicontroller@ambil_semua_resep')->middleware('jwtAuth');
Route::get('resep/{id}','apicontroller@ambil_satu_resep')->middleware('jwtAuth');
Route::post('resep/tambah_resep','apicontroller@insert_data_resep')->middleware('jwtAuth');
Route::post('resep/update', 'apicontroller@update_data_resep')->middleware('jwtAuth');
Route::post('resep/delete', 'apicontroller@delete_data_resep')->middleware('jwtAuth');

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');
Route::get('logout', 'Api\AuthController@logout');