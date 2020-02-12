<?php

namespace App\Http\Controllers;

use App\Ninthziauddinboardbio;
use App\School;
use App\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;


class NinthziauddinboardbioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data = Ninthziauddinboardbio::with('studentinfo.schoolname')->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

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

        }

        $ninthexamuniquekey = $request['enrollmentnumber'].$request['yearofappearing'];

        $studentid = Student::firstorCreate(['ninthexamuniquekey'=> $ninthexamuniquekey],['studentname'=> $request['studentname'],'fathername'=> $request['fathername'],'schoolid'=> $schoolid,'enrollmentnumber'=> $request['enrollmentnumber'],'dateofbirth' => $request['dateofbirth'],'ninthexamuniquekey'=> $ninthexamuniquekey]);


        $totalmarks = $request['englishmarks']+ $request['sindhimarks']+ $request['pakistanstudiesmark']+ $request['chemistrytheorymarks']+$request['chemistrypracticalmarks']+$request['biotheorymarks']+$request['biopracticalmarks'] ;

        error_log($studentid);


         $percent = $totalmarks/425 *100;
         $englishpercent =$request['englishmarks']/75 *100 ;
         $sindhipercent = $request['sindhimarks']/75 *100 ;
         $pakistanstudiespercent = $request['pakistanstudiesmark']/75 *100 ;
         $chemistrypercent = ($request->chemistrytheorymarks + $request->chemistrypracticalmarks)/100 *100;
         $biopercent =  ($request->biotheorymarks + $request->biopracticalmarks)/100 *100 ;

         $percentarray = array($englishpercent,$sindhipercent,$pakistanstudiespercent,$chemistrypercent,$biopercent);

         $grade = $this->gradecalculation($percent);


        $passarray = array_filter($percentarray,array($this,'checkpassstatus'));
         

         $clearedsubject = count($passarray);

         $passingstatus = 'pass';

         if ($clearedsubject < 5){
            $passingstatus = 'failed';
         }

         $ninthbioclass =  new Ninthziauddinboardbio();

         $ninthbioclass->EnglishMarks = $request->englishmarks;
         $ninthbioclass->SindhiMarks = $request->sindhimarks;
         $ninthbioclass->PakistanStudiesMark = $request->pakistanstudiesmark;
         $ninthbioclass->ChemistryTheoryMarks = $request->chemistrytheorymarks;
         $ninthbioclass->ChemistryPracticalMarks = $request->chemistrypracticalmarks;
         $ninthbioclass->BioTheoryMarks = $request->biotheorymarks;
         $ninthbioclass->BioPracticalMarks = $request->biopracticalmarks;
         $ninthbioclass->TotalChemistryMarks = $request->chemistrytheorymarks + $request->chemistrypracticalmarks;
         $ninthbioclass->TotalBioMarks = $request->biotheorymarks + $request->biopracticalmarks;
         $ninthbioclass->TotalMarks = $totalmarks;
         $ninthbioclass->OverallPercentage = $percent;
         $ninthbioclass->EnglishPercentage = $englishpercent;
         $ninthbioclass->SindhiPercentage = $sindhipercent;
         $ninthbioclass->PakistanStudiesPercentage = $pakistanstudiespercent;
         $ninthbioclass->ChemistryPercentage = $chemistrypercent;
         $ninthbioclass->BioPercentage = $biopercent;
         $ninthbioclass->grade = $grade;
         $ninthbioclass->Totalclearedpaper = $clearedsubject;
         $ninthbioclass->examtype = 'Annual';
         $ninthbioclass->PassingStatus = $passingstatus;                       
         $ninthbioclass->enrollmentnumber = $ninthexamuniquekey;
         $ninthbioclass -> save();
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
            $schoolid = School::firstOrCreate(['schoolname'=> $items['schoolname']]);
            error_log($schoolid);

            $ninthexamuniquekey = $items['enrollmentnumber'].$items['yearofappearing'];

            $studentid = Student::firstorCreate(['ninthexamuniquekey'=> $ninthexamuniquekey],['studentname'=> $items['studentname'],'fathername'=> $items['fathername'],'schoolid'=> $schoolid['id'],'enrollmentnumber'=> $items['enrollmentnumber'],'dateofbirth' => $items['dateofbirth'],'ninthexamuniquekey'=> $ninthexamuniquekey]);


            $totalmarks = $items['englishmarks']+ $items['sindhimarks']+ $items['pakistanstudiesmark']+ $items['chemistrytheorymarks']+$items['chemistrypracticalmarks']+$items['biotheorymarks']+$items['biopracticalmarks'] ;


            $chemistrytotalmarks = $items['chemistrytheorymarks'] + $items['chemistrypracticalmarks'] ;
            $biototalmarks = $items['biotheorymarks'] + $items['biopracticalmarks'] ;
            $percent = $totalmarks/425 *100;
            $englishpercent =$items['englishmarks']/75 *100 ;
            $sindhipercent = $items['sindhimarks']/75 *100 ;
            $pakistanstudiespercent = $items['pakistanstudiesmark']/75 *100 ;
            $chemistrypercent = $chemistrytotalmarks/100 *100;
            $biopercent =  $biototalmarks/100 *100 ;

            $percentarray = array($englishpercent,$sindhipercent,$pakistanstudiespercent,$chemistrypercent,$biopercent);

         
         
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
                 'ChemistryTheoryMarks' => $items['chemistrytheorymarks']?? 'A',
                 'ChemistryPracticalMarks' => $items['chemistrypracticalmarks']?? 'A',
                 'BioTheoryMarks' => $items['biotheorymarks'] ?? 'A',
                 'BioPracticalMarks' => $items['biopracticalmarks'] ?? 'A',
                 'TotalChemistryMarks' => $chemistrytotalmarks,
                 'TotalBioMarks' => $biototalmarks,
                 'TotalMarks' => $totalmarks,
                 'OverallPercentage' => $percent,
                 'EnglishPercentage' => $englishpercent,
                 'SindhiPercentage' => $sindhipercent,
                 'PakistanStudiesPercentage' => $pakistanstudiespercent,
                 'ChemistryPercentage' => $chemistrypercent,
                 'BioPercentage'=> $biopercent,
                 'grade' => $grade,
                 'Totalclearedpaper' => $clearedsubject,
                 'examtype' => 'Annual',
                 'PassingStatus' => $passingstatus,
                 'enrollmentnumber' => $ninthexamuniquekey,
                 'created_at' => $now,
                 'updated_at' => $now
             ];


        } 
        Ninthziauddinboardbio::insert($formattedarray);
        return response()->json([
    'success' => true
                ]);

    }



       public function checkpassstatus($arrvalue){

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


    /**
     * Display the specified resource.
     *
     * @param  \App\Ninthziauddinboardbio  $ninthziauddinboardbio
     * @return \Illuminate\Http\Response
     */
    public function show(Ninthziauddinboardbio $ninthziauddinboardbio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ninthziauddinboardbio  $ninthziauddinboardbio
     * @return \Illuminate\Http\Response
     */
    public function edit(Ninthziauddinboardbio $ninthziauddinboardbio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ninthziauddinboardbio  $ninthziauddinboardbio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ninthziauddinboardbio $ninthziauddinboardbio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ninthziauddinboardbio  $ninthziauddinboardbio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ninthziauddinboardbio $ninthziauddinboardbio)
    {
        //
    }
}
