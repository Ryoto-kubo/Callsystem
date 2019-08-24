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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/'                    ,'TopController@getIndex');
Route::get('/manage'              ,'ManageController@index');
Route::get('/reception/count'     ,'ReceptionIndexController@index');
Route::get('/reception/min'       ,'ReceptionIndexController@getWaitingMin');
Route::get('/reception/form'      ,'ReceptionFormController@index');
Route::post('/reception/validate' ,'ReceptionConfirmController@formValidate');
Route::post('/reception/formpost' ,'ReceptionConfirmController@formpost');
