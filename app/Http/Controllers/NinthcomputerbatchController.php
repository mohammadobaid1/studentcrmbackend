<?php

namespace App\Http\Controllers;

use App\Ninthcomputerbatch;
use App\School;
use Illuminate\Http\Request;

class NinthcomputerbatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Ninthcomputerbatch::all();

    }

    public function getrecordbyrollnumber(Request $request){

        return Ninthcomputerbatch::where('studentrollnumber',$request["rollnumber"]);

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

        $ninthcomputerclass = new Ninthcomputerbatch();
        error_log($request['englishmarks']);
        $ninthcomputerclass->studentname =  $request->studentname;
        $ninthcomputerclass->studentfathername =  $request->studentfathername;
        $ninthcomputerclass->studentrollnumber =  $request->studentrollnumber;
        $ninthcomputerclass->englishmarks =  $request->englishmarks;
        $ninthcomputerclass->urdumarks =  $request->urdumarks;
        $ninthcomputerclass->islamiatmarks =  $request->islamiatmarks;
        $ninthcomputerclass->sindhimarks =  $request->sindhimarks;
        $ninthcomputerclass->computermarks =  $request->computermarks;
        $totalmarks = $request['englishmarks']+$request['urdumarks']+$request['islamiatmarks']+$request['sindhimarks']+$request['computermarks'];
        $percent = $totalmarks/500 *100;
        $ninthcomputerclass->totalmarks =  $totalmarks;
        $ninthcomputerclass->percentage = $percent;
        $grade = $this->gradecalculation($percent);
        error_log($grade);
        $ninthcomputerclass->grade = $grade;
        $ninthcomputerclass->schoolid = $schoolid;
        $ninthcomputerclass -> save();


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

        // $schooldata = School::pluck('id','schoolname')->toArray();
        $data = $request->json()->all();
        $formattedarray = [];
        foreach( $data as $items){
            $now = Carbon::now('utc')->toDateTimeString();
            error_log($items['schoolname']);
             $schoolid = School::firstOrCreate(['schoolname'=> $items['schoolname']]);
             $totalmarks = $items['englishmarks']+$items['urdumarks']+$items['islamiatmarks']+$items['sindhimarks']+$items['computermarks']; ;
             $percent = $totalmarks/500 *100;
             $grade = $this->gradecalculation($percent);
             $formattedarray[]=[
                 'studentname' => $items['studentname'],
                 'studentfathername' => $items['studentfathername'],
                 'studentrollnumber' => $items['studentrollnumber'],
                 'englishmarks' => $items['englishmarks'],
                 'urdumarks' => $items['urdumarks'],
                 'islamiatmarks' => $items['islamiatmarks'],
                 'sindhimarks' => $items['sindhimarks'],
                 'computermarks' => $items['computermarks'],
                 'totalmarks' => $totalmarks,
                 'percentage' => $percent,
                 'grade' => $grade,
                 'schoolid' => $schoolid['id'],
                 'created_at' => $now,
                 'updated_at' => $now
             ];


        } 
        Ninthclass::insert($formattedarray);
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
     * @param  \App\Ninthcomputerbatch  $ninthcomputerbatch
     * @return \Illuminate\Http\Response
     */
    public function show(Ninthcomputerbatch $ninthcomputerbatch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ninthcomputerbatch  $ninthcomputerbatch
     * @return \Illuminate\Http\Response
     */
    public function edit(Ninthcomputerbatch $ninthcomputerbatch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ninthcomputerbatch  $ninthcomputerbatch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ninthcomputerbatch $ninthcomputerbatch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ninthcomputerbatch  $ninthcomputerbatch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ninthcomputerbatch $ninthcomputerbatch)
    {
        //
    }
}
