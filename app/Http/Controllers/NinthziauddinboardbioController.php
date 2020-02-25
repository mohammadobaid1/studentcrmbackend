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


    public function deleteuser(Request $request){
      
     //   $data = $request->json()->all();
        //error_log($data);


        $userninthdata = Ninthziauddinboardbio::find($request['id']);
        $user = Student::find($request['studentinfo']['id']);
        $userninthdata->delete();
        $user->delete();

        
        
        

        
        return response()->json([
            'success'   =>  true
        ], 200);


    }


    public function updaterecords(Request $request){


        $user =  Student::find($request['studentid']);
        $user->studentname = $request['name'];
        $user->fathername = $request['fathername'];
        $user->save();


        $totalmarks = $request['englishmarks']+ $request['sindhimarks']+ $request['pakistanstudiesmarks']+ $request['chemistrytheory']+$request['chemistrypractical']+$request['biotheory']+$request['biopractical'] ;

        $totalchemmarks = $request['chemistrytheory'] + $request['chemistrypractical'];
        $totalbiomarks = $request['biotheory'] + $request['biopractical'];


          $percent = $totalmarks/425 *100;
         $englishpercent =$request['englishmarks']/75 *100 ;
         $sindhipercent = $request['sindhimarks']/75 *100 ;
         $pakistanstudiespercent = $request['pakistanstudiesmarks']/75 *100 ;
         $chemistrypercent = $totalchemmarks/100 *100;
         $biopercent =  $totalbiomarks/100 *100 ;

         $percentarray = array($englishpercent,$sindhipercent,$pakistanstudiespercent,$chemistrypercent,$biopercent);

         $grade = $this->gradecalculation($totalmarks);


        $passarray = array_filter($percentarray,array($this,'checkpassstatus'));
         

         $clearedsubject = count($passarray);

         $passingstatus = 'pass';

         if ($clearedsubject < 5){
            $passingstatus = 'failed';
         }


        $record = Ninthziauddinboardbio::find($request['recordid']);
        $record->englishmarks = $request['englishmarks'];
        $record->sindhimarks = $request['sindhimarks'];
        $record->pakistanstudiesmark = $request['pakistanstudiesmarks'];
        $record->biotheorymarks = $request['biotheory'];
        $record->biopracticalmarks = $request['biopractical'];
        $record->chemistrytheorymarks = $request['chemistrytheory'];
        $record->chemistrypracticalmarks = $request['chemistrypractical'];
        $record->totalchemistrymarks = $totalchemmarks;
        $record->totalbiomarks = $totalbiomarks;
        $record->englishpercentage = $englishpercent;
        $record->sindhipercentage = $sindhipercent;
        $record->pakistanstudiespercentage = $pakistanstudiespercent;
        $record->chemistrypercentage = $chemistrypercent;
        $record->biopercentage = $biopercent;
        $record->overallpercentage = $percent;
        $record->totalclearedpaper = $clearedsubject;
        $record->grade = $grade;


        $record->save();

        return response()->json([
            'success'   =>  true
        ], 200);


    }




       public function search(Request $request){

        error_log($request);
        
        $studentname = $request->studentname;
        $fathername = $request->fathername;
        $rollnumber = $request->enrollmentnumber;
        $schoolname = $request->schoolname;

        
        $wherearray=['students.studentname'=>$studentname,'students.fathername'=> $fathername,'students.enrollmentnumber'=>$rollnumber];

        $schoolid = School::where('schoolname',$schoolname)->value('id');
 
        error_log($schoolid);

         $userdata = Student::with('schoolname')->with('ninthbiodata')->where('studentname',$studentname)->orWhere('enrollmentnumber',$rollnumber)->orWhere('fathername',$fathername)->orWhere('schoolid',$schoolid)->get();

        $userdataarray = $userdata->toArray(); 
         
       


         return $userdataarray ;     
        
        

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

         $grade = $this->gradecalculation($totalmarks);


        $passarray = array_filter($percentarray,array($this,'checkpassstatus'));
         

         $clearedsubject = count($passarray);

         $passingstatus = 'pass';

         if ($clearedsubject < 5){
            $passingstatus = 'failed';
         }

         $ninthbioclass =  new Ninthziauddinboardbio();

         $ninthbioclass->englishmarks = $request->englishmarks;
         $ninthbioclass->sindhimarks = $request->sindhimarks;
         $ninthbioclass->pakistanstudiesmark = $request->pakistanstudiesmark;
         $ninthbioclass->chemistrytheorymarks = $request->chemistrytheorymarks;
         $ninthbioclass->chemistrypracticalmarks = $request->chemistrypracticalmarks;
         $ninthbioclass->biotheorymarks = $request->biotheorymarks;
         $ninthbioclass->biopracticalmarks = $request->biopracticalmarks;
         $ninthbioclass->totalchemistrymarks = $request->chemistrytheorymarks + $request->chemistrypracticalmarks;
         $ninthbioclass->totalbiomarks = $request->biotheorymarks + $request->biopracticalmarks;
         $ninthbioclass->totalmarks = $totalmarks;
         $ninthbioclass->overallpercentage = $percent;
         $ninthbioclass->englishpercentage = $englishpercent;
         $ninthbioclass->sindhipercentage = $sindhipercent;
         $ninthbioclass->pakistanstudiespercentage = $pakistanstudiespercent;
         $ninthbioclass->chemistrypercentage = $chemistrypercent;
         $ninthbioclass->biopercentage = $biopercent;
         $ninthbioclass->grade = $grade;
         $ninthbioclass->totalclearedpaper = $clearedsubject;
         $ninthbioclass->examtype = 'Annual';
         $ninthbioclass->passingstatus = $passingstatus;                       
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

           
           if ($items['englishmarks'] == 'A'){
            $items['englishmarks'] = '';

           }

           if ($items['sindhimarks'] == 'A'){
            $items['sindhimarks'] = '';

           }

           if ($items['pakistanstudiesmark'] == 'A'){
            $items['pakistanstudiesmark'] = '';

           }


            if ($items['chemistrytheorymarks'] == 'A'){
                $items['chemistrytheorymarks'] = '';

           }


            if ($items['chemistrypracticalmarks'] == 'A'){
                $items['chemistrypracticalmarks'] = '';

           }


            if ($items['biotheorymarks'] == 'A'){
                $items['biotheorymarks'] = '';

           }



            if ($items['biopracticalmarks'] == 'A'){
                $items['biopracticalmarks'] = '';

           }



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

         
         
            $grade = $this->gradecalculation($totalmarks);

            $passarray = array_filter($percentarray,array($this,'checkpassstatus'));
            

            $clearedsubject = count($passarray);

            $passingstatus = 'pass';

            if ($clearedsubject < 5){
                $passingstatus = 'failed';
            }

            $formattedarray[]=[
                 'englishmarks' => $items['englishmarks'] ?? 'A',
                 'sindhimarks' => $items['sindhimarks'] ?? 'A',
                 'pakistanstudiesmark' => $items['pakistanstudiesmark'] ?? 'A',
                 'chemistrytheorymarks' => $items['chemistrytheorymarks']?? 'A',
                 'chemistrypracticalmarks' => $items['chemistrypracticalmarks']?? 'A',
                 'biotheorymarks' => $items['biotheorymarks'] ?? 'A',
                 'biopracticalmarks' => $items['biopracticalmarks'] ?? 'A',
                 'totalchemistrymarks' => $chemistrytotalmarks,
                 'totalbiomarks' => $biototalmarks,
                 'totalmarks' => $totalmarks,
                 'overallpercentage' => $percent,
                 'englishpercentage' => $englishpercent,
                 'sindhipercentage' => $sindhipercent,
                 'pakistanstudiespercentage' => $pakistanstudiespercent,
                 'chemistrypercentage' => $chemistrypercent,
                 'biopercentage'=> $biopercent,
                 'grade' => $grade,
                 'totalclearedpaper' => $clearedsubject,
                 'examtype' => 'Annual',
                 'passingstatus' => $passingstatus,
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


     public function gradecalculation($totalmarks){
        error_log($totalmarks);

        if ($totalmarks > 680)
        {
            return "A";
        }

        elseif ($totalmarks > 594 and $totalmarks <= 670 ){
            return "B";
        }

        elseif ($totalmarks > 509 and $totalmarks <= 594 ){
            return "C";
        }

        elseif ($totalmarks > 424 and $totalmarks <= 509 ){
            return "D";
        }

        elseif ($totalmarks > 339 and $totalmarks <= 424 ){
            return "D";
        }

        else if ($totalmarks < 340){
            return "E";
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
