<?php

namespace App\Http\Controllers;

use App\Firstyearpreengineeringbatch;
use App\School;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FirstyearpreengineeringbatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Firstyearpreengineeringbatch::all();
    }


    public function getrecordbyrollnumber(Request $request){
        return Firstyearpreengineeringbatch::where('studentrollnumber',$request['rollnumber']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        error_log($request);
        
         if ($request->schoolid)
        {  
            error_log($request->schoolid);
            $schoolid = $request["schoolid"];
        }

        else if ($request->schoolname) {
         error_log("here1");   
        $school = School::firstorCreate(['schoolname'=> $request["schoolname"]]);
         
        $schoolid = $school['id'];
        error_log($schoolid);
        error_log("here");
        }

        $firstyearpreengclass = new Firstyearpreengineeringbatch();
        error_log($request['englishmarks']);
        $firstyearpreengclass->studentname =  $request->studentname;
        $firstyearpreengclass->studentfathername =  $request->studentfathername;
        $firstyearpreengclass->studentrollnumber =  $request->studentrollnumber;
        $firstyearpreengclass->englishmarks =  $request->englishmarks;
        $firstyearpreengclass->urdumarks =  $request->urdumarks;
        $firstyearpreengclass->islamiatmarks =  $request->islamiatmarks;
        $firstyearpreengclass->physicsmarks =  $request->physicsmarks;
        $firstyearpreengclass->chemistrymarks =  $request->chemistrymarks;
        $firstyearpreengclass->mathsmarks =  $request->mathsmarks;
        $totalmarks = $request['englishmarks']+$request['urdumarks']+$request['islamiatmarks']+$request['physicsmarks']+$request['chemistrymarks']+$request['mathmarks'];
        error_log("total marks");
        error_log($totalmarks);
        $percent = $totalmarks/600 *100;
        error_log("percentage");
        error_log($percent); 
        $firstyearpreengclass->totalmarks =  $totalmarks;
        $firstyearpreengclass->percentage = $percent;
        $grade = $this->gradecalculation($percent);
        error_log($grade);
        $firstyearpreengclass->grade = $grade;
        $firstyearpreengclass->schoolid = $schoolid;
        $firstyearpreengclass -> save();


    }


       public function gradecalculation($percentage){
        error_log($percentage);

        if ($percentage > 80)
        {
            return "A";
        }

        elseif ($percentage > 70 and $percentage <= 80 ){
            return "B";
        }

        elseif ($percentage > 60 and $percentage <= 70 ){
            return "C";
        }

        elseif ($percentage > 50 and $percentage <= 60 ){
            return "D";
        }

        else {
            return "N/A";
        }


        }





    public function bulkrecordinsert(Request $request){
        error_log($request);
        $data = $request->json()->all();
        $formattedarray = [];
 //       error_log($data);
        foreach( $data as $items){

            $now = Carbon::now('utc')->toDateTimeString();
            error_log($items['schoolname']);
             $schoolid = School::firstOrCreate(['schoolname'=> $items['schoolname']]);
             $totalmarks = $items['englishmarks']+$items['urdumarks']+$items['islamiatmarks']+$items['physicsmarks']+$items['chemistrymarks']+ $items['mathsmarks'] ;
             $percent = $totalmarks/500 *100;
             $grade = $this->gradecalculation($percent);
             $formattedarray[]=[
                 'studentname' => $items['studentname'],
                 'studentfathername' => $items['fathername'],
                 'studentrollnumber' => $items['rollnumber'],
                 'englishmarks' => $items['englishmarks'],
                 'urdumarks' => $items['urdumarks'],
                 'islamiatmarks' => $items['islamiatmarks'],
                 'physicsmarks' => $items['physicsmarks'],
                 'chemistrymarks' => $items['chemistrymarks'],
                 'mathsmarks' => $items['mathsmarks'],
                 'totalmarks' => $totalmarks,
                 'percentage' => $percent,
                 'grade' => $grade,
                 'schoolid' => $schoolid['id'],
                 'created_at' => $now,
                 'updated_at' => $now
             ];


        } 
       Firstyearpreengineeringbatch::insert($formattedarray);
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
     * @param  \App\Firstyearpreengineeringbatch  $firstyearpreengineeringbatch
     * @return \Illuminate\Http\Response
     */
    public function show(Firstyearpreengineeringbatch $firstyearpreengineeringbatch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Firstyearpreengineeringbatch  $firstyearpreengineeringbatch
     * @return \Illuminate\Http\Response
     */
    public function edit(Firstyearpreengineeringbatch $firstyearpreengineeringbatch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Firstyearpreengineeringbatch  $firstyearpreengineeringbatch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Firstyearpreengineeringbatch $firstyearpreengineeringbatch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Firstyearpreengineeringbatch  $firstyearpreengineeringbatch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Firstyearpreengineeringbatch $firstyearpreengineeringbatch)
    {
        //
    }
}
