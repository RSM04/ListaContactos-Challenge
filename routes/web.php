<?php
use App\Exports\ContactListExport;
use Maatwebsite\Excel\Facades\Excel;
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
Route::get('/categories',array('uses' =>'ContactListController@totalcategories','as'=>'categoriesjson'));
Route::delete('/contacto/{id}/destroy','ContactListController@destroy');
Route::get('/contacts/{name}/{surname}/{email}','ContactListController@crear');
Route::post('/contacts/{id}','ContactListController@update');
Route::resource('/contacts','ContactListController');
Route::get('/contacts/pagination/{page}','ContactListController@paginacion');
Route::get('/toexcel',array('uses'=>function(){
    return Excel::download(new ContactListExport,'Contacts-export.xlsx');
},'as'=>'excel'));
Route::get('/categoria/add/{nombre}',array('uses'=>'CategoriesController@create','as'=>'crearcategoria'));
