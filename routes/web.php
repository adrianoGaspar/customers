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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/customers/get/all', 'CustomerController@getAll')->name('customers.get.all');
Route::post('/customer', 'CustomerController@store')->name('customer.store');
Route::put('/customer/{id}', 'CustomerController@update')->name('customer.update');
Route::delete('/customer/{id}', 'CustomerController@destroy')->name('customer.destroy');
Route::get('/customer/{id}', 'CustomerController@show')->name('customer.show');
