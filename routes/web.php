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

Route::prefix('reception')->group(function () {
    Route::get('/count'     ,'ReceptionIndexController@index');
    Route::get('/min'       ,'ReceptionIndexController@getWaitingMin');
    Route::get('/form'      ,'ReceptionFormController@index');
    Route::post('/validate' ,'ReceptionConfirmController@formValidate');
    // Route::post('/formpost' ,'ReceptionConfirmController@formpost');
});

Route::prefix('form')->group(function () {
    Route::view('/peoples', 'front/formpeople');
    Route::post('/reception/formpost', 'ReceptionConfirmController@formpost');
});
