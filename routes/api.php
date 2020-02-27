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
Route::post('deleteuser', 'APIController@deleteuser');
Route::get('listuser','APIController@listuser');
Route::post('updateuser','APIController@updateuser');
Route::get('getuser/{id}','APIController@getuser');


// Route::get('getschools',['middleware' => 'auth.role:operator','uses'=> 'SchoolController@index']);
Route::get('getschools','SchoolController@index');
// Route::get('listninthcomputerbatch','NinthcomputerbatchController@index');
// Route::get('listninthmedicalbatch','NinthmedicalbatchController@index');
Route::get('listmatricbatch','MatricbatchController@index');

Route::get('listfirstpreengineeringbatch','FirstyearpreengineeringbatchController@index');
Route::get('listfirstpremedicalbatch','FirstyearpremedicalbatchController@index');
Route::get('listsecondpreengineeringbatch','SecondyearpreengineeringbatchController@index');
Route::get('listsecondpremedicalbatch','SecondyearpremedicalbatchController@index');
// Route::post('addninthcomputerstudent','NinthcomputerbatchController@create');
// Route::post('addninthmedicalstudent','NinthmedicalbatchController@create');
//Route::post('addmatricstudent','MatricbatchController@create');
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

// HSC pre med

Route::get('hsconepremed','HsconepremedController@index');
Route::post('hsconepremed','HsconepremedController@create');
Route::post('bulkhsconepremed','HsconepremedController@bulkrecordinsert');

// HSC pre eng
Route::get('hsconepreeng','HsconepreengController@index');
Route::post('hsconepreeng','HsconepreengController@create');
Route::post('bulkhsconepreeng','HsconepreengController@bulkrecordinsert');

// HSC general science

Route::get('hsconegeneralscience','HsconegeneralscienceController@index');
Route::post('hsconegeneralscience','HsconegeneralscienceController@create');
Route::post('bulkhsconegeneralscience','HsconegeneralscienceController@bulkrecordinsert');

// HSC commerce
Route::get('hsconecommerce','HsconecommerceController@index');
Route::post('hsconecommerce','HsconecommerceController@create');
Route::post('bulkhsconecommerce','HsconecommerceController@bulkrecordinsert');

// HSC humanities
Route::get('hsconehumanities','HsconehumanitiesController@index');
Route::post('hsconehumanities','HsconehumanitiesController@create');
Route::post('bulkhsconehumanities','HsconehumanitiesController@bulkrecordinsert');


// Ninth Computer

Route::get('getninthtest','NinthziauddinboardcomputerController@index');
Route::post('inserttestdata','NinthziauddinboardcomputerController@create');
Route::post('bulkinsertziauddinninth', 'NinthziauddinboardcomputerController@bulkinsert');
Route::post('searchninthsciencedata','NinthziauddinboardcomputerController@search');
Route::post('deleteninthsciencedata','NinthziauddinboardcomputerController@deleteuser');
Route::post('editninthsciencedata','NinthziauddinboardcomputerController@updaterecords');
//   Ninth bio 


//   Ninth bio

Route::get('getninthbio','NinthziauddinboardbioController@index');
Route::post('bulkinsertziauddinninthbio', 'NinthziauddinboardbioController@bulkinsert');
Route::post('insertninthbio','NinthziauddinboardbioController@create');
Route::post('searchninthbiodata','NinthziauddinboardbioController@search');
Route::post('deleteninthbiodata','NinthziauddinboardbioController@deleteuser');
Route::post('editninthbiodata','NinthziauddinboardbioController@updaterecords');



// Ninth General Group

Route::get('getninthgeneral','NinthziauddinboardgeneralgroupController@index');
Route::post('bulkinsertziauddinninthgeneral', 'NinthziauddinboardgeneralgroupController@bulkinsert');
Route::post('insertninthgeneral','NinthziauddinboardgeneralgroupController@create');
Route::post('searchninthgeneraldata','NinthziauddinboardgeneralgroupController@search');
Route::post('deleteninthgeneraldata','NinthziauddinboardgeneralgroupController@deleteuser');
Route::post('editninthgeneraldata','NinthziauddinboardgeneralgroupController@updaterecords');



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
