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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/patients/new', 'PatientController@index');
Route::post('/patients/create', 'PatientController@create');
Route::get('/patients/search', 'PatientController@smartSearch');
Route::get('/patients/card/{id}', 'PatientController@card');
Route::post('/patients/edit', 'PatientController@edit');

Route::get('/examinations/new', 'ExaminationController@index');
Route::post('/examinations/new', 'ExaminationController@create');

Route::get('/examinations/edit/{id}', 'ExaminationController@edit');
Route::post('/examinations/edit', 'ExaminationController@editPost');

Route::get('/documents/inspect/{id}', 'DocumentController@inspect');
Route::get('/documents/new', 'DocumentController@index');
Route::post('/documents/new', 'DocumentController@create');

Route::get('/test', 'ExaminationController@test');
Route::get('/retrieveData/{identity}/{birthYear}/{opNo}', 'ExaminationController@retrieveData');
