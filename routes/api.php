<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'APIController@login');
Route::post('register', 'APIController@register');

Route::get('getschools','SchoolController@index');
Route::get('listninthcomputerbatch','NinthcomputerbatchController@index');
Route::get('listninthmedicalbatch','NinthmedicalbatchController@index');
Route::get('listmatricbatch','MatricbatchController@index');
Route::get('listfirstpreengineeringbatch','FirstyearpreengineeringbatchController@index');
Route::get('listfirstpremedicalbatch','FirstyearpremedicalbatchController@index');
Route::get('listsecondpreengineeringbatch','Secondyearpreengineeringbatch@index');
Route::get('listsecondpremedicalbatch','SecondyearpremedicalbatchController@index');
Route::post('addninthcomputerstudent','NinthcomputerbatchController@create');
Route::post('addninthmedicalstudent','NinthmedicalbatchController@create');
Route::post('addmatricstudent','MatricbatchController@create');
Route::post('addfirstyearpreengstudent','FirstyearpreengineeringbatchController@create');
Route::post('addfirstyearpremedstudent','FirstyearpremedicalbatchController@create');
Route::post('addsecondyearpreengstudent','Secondyearpreengineeringbatch@create');
Route::post('addsecondyearpremedstudent','SecondyearpremedicalbatchController@create');
Route::post('bulkninthcomputerbatch','NinthcomputerbatchController@bulkrecordinsert');
Route::post('bulkninthmedicalbatch','NinthmedicalbatchController@bulkrecordinsert');
Route::post('bulkmatricbatch','MatricbatchController@bulkrecordinsert');
Route::post('bulkfirstyearpreengbatch','FirstyearpreengineeringbatchController@bulkrecordinsert');
Route::post('bulkfirstyearpremedbatch','FirstyearpremedicalbatchController@bulkrecordinsert');
Route::post('bulksecondyearpreengbatch','Secondyearpreengineeringbatch@bulkrecordinsert');
Route::post('bulksecondyearpremedbatch','SecondyearpremedicalbatchController@bulkrecordinsert');
