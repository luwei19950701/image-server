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

Route::any('example', function () {
    return view('example');
});

Route::get('/{path}', 'StorageController@images')->where(['path' => 'storage\/images\/.*?']);
Route::get('holder/{width}/{height}/{color?}', 'StorageController@holder');