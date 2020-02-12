<?php

namespace App\Http\Controllers;

use App\Secondyearpreengineeringbatch;
use App\School;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SecondyearpreengineeringbatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Secondyearpreengineeringbatch::all();
    }

    public function getrecordbyrollnumber(Request $request){
        return Secondyearpreengineeringbatch::where('studentrollnumber',$request['rollnumber']);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

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

        $secondyearpreengclass = new Secondyearpreengineeringbatch();
        error_log($request['englishmarks']);
        $secondyearpreengclass->studentname =  $request->studentname;
        $secondyearpreengclass->studentfathername =  $request->studentfathername;
        $secondyearpreengclass->studentrollnumber =  $request->studentrollnumber;
        $secondyearpreengclass->englishmarks =  $request->englishmarks;
        $secondyearpreengclass->urdumarks =  $request->urdumarks;
        $secondyearpreengclass->pakistanstudiesmarks =  $request->pakistanstudiesmarks;
        $secondyearpreengclass->physicsmarks =  $request->physicsmarks;
        $secondyearpreengclass->chemistrymarks =  $request->chemistrymarks;
        $secondyearpreengclass->mathmarks =  $request->mathsmarks;
        $totalmarks = $request['englishmarks']+$request['urdumarks']+$request['pakistanstudiesmarks']+$request['physicsmarks']+$request['chemistrymarks']+$request['mathsmarks'];
        $percent = $totalmarks/500 *100;
        $secondyearpreengclass->totalmarks =  $totalmarks;
        $secondyearpreengclass->percentage = $percent;
        $grade = $this->gradecalculation($percent);
        error_log($grade);
        $secondyearpreengclass->grade = $grade;
        $secondyearpreengclass->schoolid = $schoolid;
        $secondyearpreengclass -> save();

        
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
             $totalmarks = $items['englishmarks']+$items['urdumarks']+$items['pakistanstudiesmarks']+$items['physicsmarks']+$items['chemistrymarks']+ $items['mathsmarks'] ;
             $percent = $totalmarks/500 *100;
             $grade = $this->gradecalculation($percent);
             $formattedarray[]=[
                 'studentname' => $items['studentname'],
                 'studentfathername' => $items['fathername'],
                 'studentrollnumber' => $items['rollnumber'],
                 'englishmarks' => $items['englishmarks'],
                 'urdumarks' => $items['urdumarks'],
                 'pakistanstudiesmarks' => $items['pakistanstudiesmarks'],
                 'physicsmarks' => $items['physicsmarks'],
                 'chemistrymarks' => $items['chemistrymarks'],
                 'mathmarks' => $items['mathsmarks'],
                 'totalmarks' => $totalmarks,
                 'percentage' => $percent,
                 'grade' => $grade,
                 'schoolid' => $schoolid['id'],
                 'created_at' => $now,
                 'updated_at' => $now
             ];


        } 
       Secondyearpreengineeringbatch::insert($formattedarray);
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
     * @param  \App\Secondyearpreengineeringbatch  $secondyearpreengineeringbatch
     * @return \Illuminate\Http\Response
     */
    public function show(Secondyearpreengineeringbatch $secondyearpreengineeringbatch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Secondyearpreengineeringbatch  $secondyearpreengineeringbatch
     * @return \Illuminate\Http\Response
     */
    public function edit(Secondyearpreengineeringbatch $secondyearpreengineeringbatch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Secondyearpreengineeringbatch  $secondyearpreengineeringbatch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Secondyearpreengineeringbatch $secondyearpreengineeringbatch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Secondyearpreengineeringbatch  $secondyearpreengineeringbatch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Secondyearpreengineeringbatch $secondyearpreengineeringbatch)
    {
        //
    }
}
