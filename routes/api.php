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


/* User Signin and logout api */

Route::post('login', 'APIController@login');
Route::post('register', 'APIController@register');
Route::post('logout','APIController@logout');


Route::get('getschools',['middleware' => 'auth.role:operator','uses'=> 'SchoolController@index']);

// Route::get('listninthcomputerbatch','NinthcomputerbatchController@index');
// Route::get('listninthmedicalbatch','NinthmedicalbatchController@index');
Route::get('listmatricbatch','MatricbatchController@index');
Route::get('listfirstpreengineeringbatch','FirstyearpreengineeringbatchController@index');
Route::get('listfirstpremedicalbatch','FirstyearpremedicalbatchController@index');
Route::get('listsecondpreengineeringbatch','SecondyearpreengineeringbatchController@index');
Route::get('listsecondpremedicalbatch','SecondyearpremedicalbatchController@index');
// Route::post('addninthcomputerstudent','NinthcomputerbatchController@create');
// Route::post('addninthmedicalstudent','NinthmedicalbatchController@create');
Route::post('addmatricstudent','MatricbatchController@create');
Route::post('addfirstyearpreengstudent','FirstyearpreengineeringbatchController@create');
Route::post('addfirstyearpremedstudent','FirstyearpremedicalbatchController@create');
Route::post('addsecondyearpreengstudent','SecondyearpreengineeringbatchController@create');
Route::post('addsecondyearpremedstudent','SecondyearpremedicalbatchController@create');
// Route::post('bulkninthcomputerbatch','NinthcomputerbatchController@bulkrecordinsert');
// Route::post('bulkninthmedicalbatch','NinthmedicalbatchController@bulkrecordinsert');
Route::post('bulkmatricbatch','MatricbatchController@bulkrecordinsert');
Route::post('bulkfirstyearpreengbatch','FirstyearpreengineeringbatchController@bulkrecordinsert');
Route::post('bulkfirstyearpremedbatch','FirstyearpremedicalbatchController@bulkrecordinsert');
Route::post('bulksecondyearpreengbatch','SecondyearpreengineeringbatchController@bulkrecordinsert');
Route::post('bulksecondyearpremedbatch','SecondyearpremedicalbatchController@bulkrecordinsert');





// Ninth Computer

Route::get('getninthtest','NinthziauddinboardcomputerController@index');
Route::post('inserttestdata','NinthziauddinboardcomputerController@create');
Route::post('bulkinsertziauddinninth', 'NinthziauddinboardcomputerController@bulkinsert');
Route::post('searchninthsciencedata','NinthziauddinboardcomputerController@search');

//   Ninth bio 

Route::get('getninthbio','NinthziauddinboardbioController@index');
Route::post('bulkinsertziauddinninthbio', 'NinthziauddinboardbioController@bulkinsert');
Route::post('insertninthbio','NinthziauddinboardbioController@create');


// Ninth General Group

Route::get('getninthgeneral','NinthziauddinboardgeneralgroupController@index');
Route::post('bulkinsertziauddinninthgeneral', 'NinthziauddinboardgeneralgroupController@bulkinsert');
Route::post('insertninthgeneral','NinthziauddinboardgeneralgroupController@create');



// Matric Science Group


Route::get('getmatricscience','MatricziauddinscienceController@index');
Route::post('bulkinsertziauddinmatricscience', 'MatricziauddinscienceController@bulkinsert');
Route::post('insertmatricscience','MatricziauddinscienceController@create');


// Matric Ziauddin General




Route::get('getmatricgeneral','MatricziauddingeneralController@index');
Route::post('bulkinsertziauddinmatricgeneral', 'MatricziauddingeneralController@bulkinsert');
Route::post('insertmatricgeneral','MatricziauddingeneralController@create');





// Get students by enrollment number 

Route::get('getstudentbyrollnumber/{enrollmentnumber}','StudentController@getstudentbyenrollmentnumber');


// Get all schools


Route::get('getallschool','SchoolController@index');