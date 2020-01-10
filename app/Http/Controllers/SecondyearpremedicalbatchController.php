<?php

namespace App\Http\Controllers;

use App\Secondyearpremedicalbatch;
use Illuminate\Http\Request;

class SecondyearpremedicalbatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return Secondyearpremedicalbatch::all();
    }


    public function getrecordbyid(Request $request){
        return Secondyearpremedicalbatch::where('studentrollnumber',$request['rollnumber']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
        $school = School::firstorCreate(['schoolname'-> $request['schoolname']]);
        $studentrecord = new Secondyearpremedicalbatch();
        
        $studentrecord->studentname =  $request['studentname'];
        $studentrecord->studentfathername =  $request['studentfathername'];
        $studentrecord->studentrollnumber =  $request['studentrollnumber'];
        $studentrecord->englishmarks =  $request['englishmarks'];
        $studentrecord->urdumarks =  $request['urdumarks'];
        $studentrecord->pakistanstudiesmarks =  $request['pakistanstudiesmarks'];
        $studentrecord->biologymarks =  $request['biologymarks'];
        $studentrecord->physicsmarks =  $request['physicsmarks'];
        $studentrecord->chemistrymarks =  $request['chemistrymarks'];
        $totalmarks = $request['englishmarks']+$request['urdumarks']+$request['pakistanstudiesmarks']+$request['biologymarks']+$request['physicsmarks']+$request['chemistrymarks'];
        $studentrecord->totalmarks =  $totalmarks;
        $studentrecord->percentage = ($totalmarks*500)/100;
        $studentrecord->grade = 'A';
        $studentrecord->schoolid = $school['id'];
        $studentrecord -> save();

    }

    public function bulkrecordinsert(Request $request){

        $data = $request->json()->all();
        $formattedarray = [];
        foreach( $data as $items){
            $now = Carbon::now('utc')->toDateTimeString();
            error_log($items['schoolname']);
             $schoolid = School::firstOrCreate(['schoolname'=> $items['schoolname']]);
             $totalmarks = $items['englishmarks']+ $items['urdumarks']+ $items['pakistanstudiesmarks'] + $items['physicsmarks'] + $items['chemistrymarks'] + $items['biologymarks'];
     //        $percentage = ($totalmarks*500)/100;
             $formattedarray[]=[
                 'studentname' => $items['studentname'],
                 'studentfathername' => $items['studentfathername'],
                 'studentrollnumber' => $items['studentrollnumber'],
                 'englishmarks' => $items['englishmarks'],
                 'urdumarks' => $items['urdumarks'],
                 'pakistanstudiesmarks' => $items['pakistanstudiesmarks'],
                 'biologymarks' => $items['biologymarks'],
                 'physicsmarks' => $items['physicsmarks'],
                 'chemistrymarks' => $items['chemistrymarks'],
                 'totalmarks' => $totalmarks,
                 'percentage' => '100.0',
                 'grade' => 'A',
                 'schoolid' => $schoolid['id'],
                 'created_at' => $now,
                 'updated_at' => $now
             ];


        } 
        Secondyearpremedicalbatch::insert($formattedarray);
        return $formattedarray;

        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Secondyearpremedicalbatch  $secondyearpremedicalbatch
     * @return \Illuminate\Http\Response
     */
    public function show(Secondyearpremedicalbatch $secondyearpremedicalbatch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Secondyearpremedicalbatch  $secondyearpremedicalbatch
     * @return \Illuminate\Http\Response
     */
    public function edit(Secondyearpremedicalbatch $secondyearpremedicalbatch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Secondyearpremedicalbatch  $secondyearpremedicalbatch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Secondyearpremedicalbatch $secondyearpremedicalbatch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Secondyearpremedicalbatch  $secondyearpremedicalbatch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Secondyearpremedicalbatch $secondyearpremedicalbatch)
    {
        //
    }
}
