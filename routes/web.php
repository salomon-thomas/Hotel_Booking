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
Route::get('/set-booking', 'HomeController@select_date')->name('select_date');
Route::post('/make-booking', 'HomeController@select_date')->name('select_date_do');
Route::post('/make-booking-do', 'HomeController@make_booking')->name('make_booking_do');
Route::get('/my-booking/', 'HomeController@my_booking')->name('my_booking');
Route::get('delete-booking/{id}',['as' => 'delete-booking/','uses' => 'HomeController@delete_booking']);

