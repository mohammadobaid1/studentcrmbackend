<?php

namespace App\Http\Controllers;

use App\Matricbatch;
use App\School;
use Illuminate\Http\Request;

class MatricbatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Matricbatch::all();
    }

    public function getrecordbyrollnumber(Request $request){

        return Matricbatch::where('studentrollnumber',$request['rollnumber']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $school = School::firstorCreate(['schoolname'-> $request['schoolname']]);
        $studentrecord = new Matricbatch();
        
        $studentrecord->studentname =  $request['studentname'];
        $studentrecord->studentfathername =  $request['studentfathername'];
        $studentrecord->studentrollnumber =  $request['studentrollnumber'];
        $studentrecord->englishmarks =  $request['englishmarks'];
        $studentrecord->urdumarks =  $request['urdumarks'];
        $studentrecord->pakistanstudiesmarks =  $request['pakistanstudiesmarks'];
        $studentrecord->mathmarks =  $request['mathmarks'];
        $studentrecord->physicsmarks =  $request['physicsmarks'];
        $totalmarks = $request['englishmarks']+$request['urdumarks']+$request['pakistanstudiesmarks']+$request['mathmarks']+$request['physicsmarks'];
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
             $totalmarks = $items['englishmarks']+ $items['urdumarks']+ $items['pakistanstudiesmarks'] + $items['mathmarks'] + $items['physicsmarks'] ;
     //        $percentage = ($totalmarks*500)/100;
             $formattedarray[]=[
                 'studentname' => $items['studentname'],
                 'studentfathername' => $items['studentfathername'],
                 'studentrollnumber' => $items['studentrollnumber'],
                 'englishmarks' => $items['englishmarks'],
                 'urdumarks' => $items['urdumarks'],
                 'pakistanstudiesmarks' => $items['pakistanstudiesmarks'],
                 'mathmarks' => $items['mathmarks'],
                 'physicsmarks' => $items['physicsmarks'],
                 'totalmarks' => $totalmarks,
                 'percentage' => '100.0',
                 'grade' => 'A',
                 'schoolid' => $schoolid['id'],
                 'created_at' => $now,
                 'updated_at' => $now
             ];


        } 
        Matricbatch::insert($formattedarray);
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
     * @param  \App\Matricbatch  $matricbatch
     * @return \Illuminate\Http\Response
     */
    public function show(Matricbatch $matricbatch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Matricbatch  $matricbatch
     * @return \Illuminate\Http\Response
     */
    public function edit(Matricbatch $matricbatch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Matricbatch  $matricbatch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matricbatch $matricbatch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Matricbatch  $matricbatch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matricbatch $matricbatch)
    {
        //
    }
}
