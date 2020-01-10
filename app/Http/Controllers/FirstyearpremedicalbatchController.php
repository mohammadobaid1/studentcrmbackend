<?php

namespace App\Http\Controllers;

use App\Firstyearpremedicalbatch;
use App\School;
use Illuminate\Http\Request;

class FirstyearpremedicalbatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Firstyearpremedicalbatch::all();
    }

    public function getrecordbyid(Request $request){
        return Firstyearpremedicalbatch::where('studentrollnumber',$request['rollnumber']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $school = School::firstorCreate(['schoolname'-> $request['schoolname']]);
        $studentrecord = new Firstyearpremedicalbatch();
        
        $studentrecord->studentname =  $request['studentname'];
        $studentrecord->studentfathername =  $request['studentfathername'];
        $studentrecord->studentrollnumber =  $request['studentrollnumber'];
        $studentrecord->englishmarks =  $request['englishmarks'];
        $studentrecord->urdumarks =  $request['urdumarks'];
        $studentrecord->islamiatmarks =  $request['islamiatmarks'];
        $studentrecord->mathmarks =  $request['biologymarks'];
        $studentrecord->physicsmarks =  $request['physicsmarks'];
        $studentrecord->chemistrymarks =  $request['chemistrymarks'];
        $totalmarks = $request['englishmarks']+$request['urdumarks']+$request['islamiatmarks']+$request['biologymarks']+$request['physicsmarks']+$request['chemistrymarks'];
        $studentrecord->totalmarks =  $totalmarks;
        $studentrecord->percentage = ($totalmarks*500)/100;
        $studentrecord->grade = 'A';
        $studentrecord->schoolid = $school['id'];
        $studentrecord -> save();

    }


    public function bulkrecordinsert(Request $request)
    {

        $data = $request->json()->all();
        $formattedarray = [];
        foreach( $data as $items){
            $now = Carbon::now('utc')->toDateTimeString();
            error_log($items['schoolname']);
             $schoolid = School::firstOrCreate(['schoolname'=> $items['schoolname']]);
             $totalmarks = $items['englishmarks']+ $items['urdumarks']+ $items['islamiatmarks'] + $items['physicsmarks'] + $items['chemistrymarks'] + $items['biologymarks'];
     //        $percentage = ($totalmarks*500)/100;
             $formattedarray[]=[
                 'studentname' => $items['studentname'],
                 'studentfathername' => $items['studentfathername'],
                 'studentrollnumber' => $items['studentrollnumber'],
                 'englishmarks' => $items['englishmarks'],
                 'urdumarks' => $items['urdumarks'],
                 'islamiatmarks' => $items['islamiatmarks'],
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
        Firstyearpremedicalbatch::insert($formattedarray);
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
     * @param  \App\Firstyearpremedicalbatch  $firstyearpremedicalbatch
     * @return \Illuminate\Http\Response
     */
    public function show(Firstyearpremedicalbatch $firstyearpremedicalbatch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Firstyearpremedicalbatch  $firstyearpremedicalbatch
     * @return \Illuminate\Http\Response
     */
    public function edit(Firstyearpremedicalbatch $firstyearpremedicalbatch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Firstyearpremedicalbatch  $firstyearpremedicalbatch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Firstyearpremedicalbatch $firstyearpremedicalbatch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Firstyearpremedicalbatch  $firstyearpremedicalbatch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Firstyearpremedicalbatch $firstyearpremedicalbatch)
    {
        //
    }
}
