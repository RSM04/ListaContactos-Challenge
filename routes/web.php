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

Route::get('/', 'ContactListController@index');
Route::get('/listcontacts',array('uses' =>'ContactListController@getcontacts','as'=>'getlistcontacts'));
Route::get('/categories',array('uses' =>'ContactListController@totalcategories','as'=>'totalcategories'));
Route::delete('/contacto/{id}/destroy','ContactListController@destroy');
Route::get('/contacts/{name}/{surname}/{email}','ContactListController@crear');
Route::resource('/contacts','ContactListController');
