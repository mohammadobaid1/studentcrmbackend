<?php

namespace App\Http\Controllers;

use App\Ninthziauddinboardgeneralgroup;
use Illuminate\Http\Request;
use App\Student;
use Carbon\Carbon;
use App\School;
class NinthziauddinboardgeneralgroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data = Ninthziauddinboardgeneralgroup::with('studentinfo.schoolname')->get();
        return $data;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
              
        $school = School::firstorCreate(['schoolname'=> 'Private']);
         
        $schoolid = $school['id'];
        error_log($schoolid);

        


        $uniquekey = $request['enrollmentnumber'].$request['yearofappearing'];

        $studentid = Student::firstorCreate(['ninthexamuniquekey'=> $uniquekey],['studentname'=> $request['studentname'],'fathername'=> $request['fathername'],'schoolid'=> $schoolid,'enrollmentnumber'=> $request['enrollmentnumber'],'dateofbirth' => $request['dateofbirth'],'ninthexamuniquekey'=> $uniquekey]);


        $totalmarks = $request['englishmarks']+ $request['sindhimarks']+ $request['pakistanstudiesmark']+ $request['generalsciencemarks']+$request['mathsmarks'] ;

       


         $percent = $totalmarks/425 *100;
         $englishpercent =$request['englishmarks']/75 *100 ;
         $sindhipercent = $request['sindhimarks']/75 *100 ;
         $pakistanstudiespercent = $request['pakistanstudiesmark']/75 *100 ;
         $generalsciencepercent = $request->generalsciencemarks/100 *100;
         $mathspercent = $request->mathsmarks/100 *100;
       
         $percentarray = array($englishpercent,$sindhipercent,$pakistanstudiespercent,$generalsciencepercent,$mathspercent);

        

         $grade = $this->gradecalculation($percent);


        $passarray = array_filter($percentarray,array($this,'checkpassstatus'));

       
         

         $clearedsubject = count($passarray);

         $passingstatus = 'pass';

         if ($clearedsubject < 5){
            $passingstatus = 'failed';
         }

         $ninthgeneralclass =  new Ninthziauddinboardgeneralgroup();

         $ninthgeneralclass->EnglishMarks = $request->englishmarks;
         $ninthgeneralclass->SindhiMarks = $request->sindhimarks;
         $ninthgeneralclass->PakistanStudiesMark = $request->pakistanstudiesmark;
         $ninthgeneralclass->GeneralScienceMarks = $request->generalsciencemarks;
         $ninthgeneralclass->MathsMarks = $request->mathsmarks;
         $ninthgeneralclass->TotalMarks = $totalmarks;
         $ninthgeneralclass->OverallPercentage = $percent;
         $ninthgeneralclass->EnglishPercentage = $englishpercent;
         $ninthgeneralclass->SindhiPercentage = $sindhipercent;
         $ninthgeneralclass->PakistanStudiesPercentage = $pakistanstudiespercent;
         $ninthgeneralclass->GeneralSciencePercentage = $generalsciencepercent;
         $ninthgeneralclass->MathsPercentage = $mathspercent;
         $ninthgeneralclass->grade = $grade;
         $ninthgeneralclass->Totalclearedpaper = $clearedsubject;
         $ninthgeneralclass->examtype = 'Annual';
         $ninthgeneralclass->PassingStatus = $passingstatus;
         $ninthgeneralclass->group = $request['group'];                       
         $ninthgeneralclass->enrollmentnumber = $uniquekey;
         $ninthgeneralclass -> save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function bulkinsert(Request $request)
    {
        //


                error_log($request);
        $data = $request->json()->all();
        $formattedarray = [];
        
        foreach( $data as $items){
             
            error_log("Items"); 
            $now = Carbon::now('utc')->toDateTimeString();
            $schoolid = School::firstOrCreate(['schoolname'=> 'Private']);
            error_log($schoolid);


           $uniquekey = $request['enrollmentnumber'].$request['yearofappearing'];


            $studentid = Student::firstorCreate(['ninthexamuniquekey'=> $uniquekey],['studentname'=> $items['studentname'],'fathername'=> $items['fathername'],'schoolid'=> $schoolid['id'],'enrollmentnumber'=> $items['enrollmentnumber'],'dateofbirth' => $items['dateofbirth'],'ninthexamuniquekey'=> $uniquekey]);


          $totalmarks = $items['englishmarks']+ $items['sindhimarks']+ $items['pakistanstudiesmark']+ $items['generalsciencemarks']+$items['mathsmarks'] ;


            
            $percent = $totalmarks/425 *100;
            $englishpercent =$items['englishmarks']/75 *100 ;
            $sindhipercent = $items['sindhimarks']/75 *100 ;
            $pakistanstudiespercent = $items['pakistanstudiesmark']/75 *100 ;
            $generalsciencepercent = $items['generalsciencemarks']/100 *100;
            $mathspercent = $items['mathsmarks']/100 *100;
       
            $percentarray = array($englishpercent,$sindhipercent,$pakistanstudiespercent,$generalsciencepercent,$mathspercent);

           

            $grade = $this->gradecalculation($percent);


            $passarray = array_filter($percentarray,array($this,'checkpassstatus'));
            $clearedsubject = count($passarray);

            $passingstatus = 'pass';

            if ($clearedsubject < 5){
                $passingstatus = 'failed';
            }

            $formattedarray[]=[
                 'EnglishMarks' => $items['englishmarks'] ?? 'A',
                 'SindhiMarks' => $items['sindhimarks'] ?? 'A',
                 'PakistanStudiesMark' => $items['pakistanstudiesmark'] ?? 'A',
                 'GeneralScienceMarks' => $items['generalsciencemarks']?? 'A',
                 'MathsMarks' => $items['mathsmarks']?? 'A',
                 'TotalMarks' => $totalmarks,
                 'OverallPercentage' => $percent,
                 'EnglishPercentage' => $englishpercent,
                 'SindhiPercentage' => $sindhipercent,
                 'PakistanStudiesPercentage' => $pakistanstudiespercent,
                 'GeneralSciencePercentage' => $generalsciencepercent,
                 'MathsPercentage'=> $mathspercent,
                 'grade' => $grade,
                 'Totalclearedpaper' => $clearedsubject,
                 'examtype' => 'Annual',
                 'PassingStatus' => $passingstatus,
                 'group' => $items['group'],
                 'enrollmentnumber' => $uniquekey,
                 'created_at' => $now,
                 'updated_at' => $now
             ];


        } 
        Ninthziauddinboardgeneralgroup::insert($formattedarray);
        return response()->json([
                        'success' => true
                ]);

    }



       public function checkpassstatus($arrvalue){

        return $arrvalue > 25;
    }

        public function checkpassstatussecond($arrvalue){
            return $arrvalue > 33;
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




    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ninthziauddinboardgeneralgroup  $ninthziauddinboardgeneralgroup
     * @return \Illuminate\Http\Response
     */
    public function show(Ninthziauddinboardgeneralgroup $ninthziauddinboardgeneralgroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ninthziauddinboardgeneralgroup  $ninthziauddinboardgeneralgroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Ninthziauddinboardgeneralgroup $ninthziauddinboardgeneralgroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ninthziauddinboardgeneralgroup  $ninthziauddinboardgeneralgroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ninthziauddinboardgeneralgroup $ninthziauddinboardgeneralgroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ninthziauddinboardgeneralgroup  $ninthziauddinboardgeneralgroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ninthziauddinboardgeneralgroup $ninthziauddinboardgeneralgroup)
    {
        //
    }
}
