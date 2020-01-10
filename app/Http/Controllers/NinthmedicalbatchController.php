<?php

namespace App\Http\Controllers;

use App\Ninthmedicalbatch;
use App\School;
use Illuminate\Http\Request;

class NinthmedicalbatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Ninthmedicalbatch::all();
    }

    public function getrecordbyrollnumber(Request $request){
        return Ninthmedicalbatch::where('studentrollnumber',$request["rollnumber"]);

    }   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $school = School::firstorCreate(['schoolname'-> $request['schoolname']]);
        $studentrecord = new Ninthmedicalbatch();
        
        $studentrecord->studentname =  $request['studentname'];
        $studentrecord->studentfathername =  $request['studentfathername'];
        $studentrecord->studentrollnumber =  $request['studentrollnumber'];
        $studentrecord->englishmarks =  $request['englishmarks'];
        $studentrecord->urdumarks =  $request['urdumarks'];
        $studentrecord->islamiatmarks =  $request['islamiatmarks'];
        $studentrecord->sindhimarks =  $request['sindhimarks'];
        $studentrecord->biologymarks =  $request['biologymarks'];
        $totalmarks = $request['englishmarks']+$request['urdumarks']+$request['islamiatmarks']+$request['sindhimarks']+$request['biologymarks'];
        $studentrecord->totalmarks =  $totalmarks;
        $studentrecord->percentage = ($totalmarks*500)/100;
        $studentrecord->grade = 'A';
        $studentrecord->schoolid = $school['id'];
        $studentrecord-> save();

    }


    public function bulkrecordinsert(Request $request){

        $data = $request->json()->all();
        $formattedarray = [];
        foreach( $data as $items){
            $now = Carbon::now('utc')->toDateTimeString();
            error_log($items['schoolname']);
             $schoolid = School::firstOrCreate(['schoolname'=> $items['schoolname']]);
             $totalmarks = $items['englishmarks']+ $items['urdumarks']+ $items['islamiatmarks'] + $items['sindhimarks'] + $items['biologymarks'] ;
     //        $percentage = ($totalmarks*500)/100;
             $formattedarray[]=[
                 'studentname' => $items['studentname'],
                 'studentfathername' => $items['studentfathername'],
                 'studentrollnumber' => $items['studentrollnumber'],
                 'englishmarks' => $items['englishmarks'],
                 'urdumarks' => $items['urdumarks'],
                 'islamiatmarks' => $items['islamiatmarks'],
                 'sindhimarks' => $items['sindhimarks'],
                 'biologymarks' => $items['biologymarks'],
                 'totalmarks' => $totalmarks,
                 'percentage' => '100.0',
                 'grade' => 'A',
                 'schoolid' => $schoolid['id'],
                 'created_at' => $now,
                 'updated_at' => $now
             ];


        } 
        Ninthmedicalbatch::insert($formattedarray);
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
     * @param  \App\Ninthmedicalbatch  $ninthmedicalbatch
     * @return \Illuminate\Http\Response
     */
    public function show(Ninthmedicalbatch $ninthmedicalbatch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ninthmedicalbatch  $ninthmedicalbatch
     * @return \Illuminate\Http\Response
     */
    public function edit(Ninthmedicalbatch $ninthmedicalbatch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ninthmedicalbatch  $ninthmedicalbatch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ninthmedicalbatch $ninthmedicalbatch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ninthmedicalbatch  $ninthmedicalbatch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ninthmedicalbatch $ninthmedicalbatch)
    {
        //
    }
}
