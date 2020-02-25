<?php

namespace App\Http\Controllers;

use App\Ninthziauddinboardcomputer;
use App\School;
use App\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;



class NinthziauddinboardcomputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        error_log("Test Message");
        $data = Ninthziauddinboardcomputer::with('studentinfo.schoolname')->get();
        //  $data = Ninthziauddinboardcomputer::all(); 
        return $data;

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

         // $userdata = Student::with('schoolname')->with('ninthcomputerdata')->where('studentname','LIKE,'%'. $studentname)->orWhere('enrollmentnumber',$rollnumber)->orWhere('fathername',$fathername)->orWhere('schoolid',$schoolid)->get();


                $userdata = Student::with('schoolname')->with('ninthcomputerdata')->where('studentname',$studentname)->orWhere('enrollmentnumber',$rollnumber)->orWhere('fathername',$fathername)->orWhere('schoolid',$schoolid)->get();

        $userdataarray = $userdata->toArray(); 
         
       


         return $userdataarray ;     
        
        

    }


       public function deleteuser(Request $request){
      
     //   $data = $request->json()->all();
        //error_log($data);


        $userninthdata = Ninthziauddinboardcomputer::find($request['id']);
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


        $totalmarks = $request['englishmarks']+ $request['sindhimarks']+ $request['pakistanstudiesmarks']+ $request['chemistrytheory']+$request['chemistrypractical']+$request['computertheory']+$request['computerpractical'] ;

        $totalchemmarks = $request['chemistrytheory'] + $request['chemistrypractical'];
        $totalcompmarks = $request['computertheory'] + $request['computerpractical'];


          $percent = $totalmarks/425 *100;
         $englishpercent =$request['englishmarks']/75 *100 ;
         $sindhipercent = $request['sindhimarks']/75 *100 ;
         $pakistanstudiespercent = $request['pakistanstudiesmarks']/75 *100 ;
         $chemistrypercent = $totalchemmarks/100 *100;
         $computerpercent =  $totalcompmarks/100 *100 ;

         $percentarray = array($englishpercent,$sindhipercent,$pakistanstudiespercent,$chemistrypercent,$computerpercent);

         $grade = $this->gradecalculation($totalmarks);


        $passarray = array_filter($percentarray,array($this,'checkpassstatus'));
         

         $clearedsubject = count($passarray);

         $passingstatus = 'pass';

         if ($clearedsubject < 5){
            $passingstatus = 'failed';
         }


        $record = Ninthziauddinboardcomputer::find($request['recordid']);
        $record->englishmarks = $request['englishmarks'];
        $record->sindhimarks = $request['sindhimarks'];
        $record->pakistanstudiesmark = $request['pakistanstudiesmarks'];
        $record->computertheorymarks = $request['computertheory'];
        $record->computerpracticalmarks = $request['computerpractical'];
        $record->chemistrytheorymarks = $request['chemistrytheory'];
        $record->chemistrypracticalmarks = $request['chemistrypractical'];
        $record->totalchemistrymarks = $totalchemmarks;
        $record->totalcomputermarks = $totalcompmarks;
        $record->englishpercentage = $englishpercent;
        $record->sindhipercentage = $sindhipercent;
        $record->pakistanstudiespercentage = $pakistanstudiespercent;
        $record->chemistrypercentage = $chemistrypercent;
        $record->computerpercentage = $computerpercent;
        $record->overallpercentage = $percent;
        $record->totalclearedpaper = $clearedsubject;
        $record->grade = $grade;


        $record->save();

        return response()->json([
            'success'   =>  true
        ], 200);


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

        }

        $uniquekey = $request['enrollmentnumber'].$request['yearofappearing'];

        $studentid = Student::firstorCreate(['ninthexamuniquekey'=> $uniquekey],['studentname'=> $request['studentname'],'fathername'=> $request['fathername'],'schoolid'=> $schoolid,'enrollmentnumber'=> $request['enrollmentnumber'],'dateofbirth' => $request['dateofbirth'],'ninthexamuniquekey'=> $uniquekey]);


        $totalmarks = $request['englishmarks']+ $request['sindhimarks']+ $request['pakistanstudiesmark']+ $request['chemistrytheorymarks']+$request['chemistrypracticalmarks']+$request['computertheorymarks']+$request['computerpracticalmarks'] ;

        error_log($studentid);


         $percent = $totalmarks/425 *100;
         $englishpercent =$request['englishmarks']/75 *100 ;
         $sindhipercent = $request['sindhimarks']/75 *100 ;
         $pakistanstudiespercent = $request['pakistanstudiesmark']/75 *100 ;
         $chemistrypercent = ($request->chemistrytheorymarks + $request->chemistrypracticalmarks)/100 *100;
         $computerpercent =  ($request->computertheorymarks + $request->computerpracticalmarks)/100 *100 ;

         $percentarray = array($englishpercent,$sindhipercent,$pakistanstudiespercent,$chemistrypercent,$computerpercent);

         $grade = $this->gradecalculation($totalmarks);


        $passarray = array_filter($percentarray,array($this,'checkpassstatus'));
         

         $clearedsubject = count($passarray);

         $passingstatus = 'pass';

         if ($clearedsubject < 5){
            $passingstatus = 'failed';
         }

         $ninthcomputerclass =  new Ninthziauddinboardcomputer();

         $ninthcomputerclass->englishmarks = $request->englishmarks;
         $ninthcomputerclass->sindhimarks = $request->sindhimarks;
         $ninthcomputerclass->pakistanstudiesmark = $request->pakistanstudiesmark;
         $ninthcomputerclass->chemistrytheorymarks = $request->chemistrytheorymarks;
         $ninthcomputerclass->chemistrypracticalmarks = $request->chemistrypracticalmarks;
         $ninthcomputerclass->computertheorymarks = $request->computertheorymarks;
         $ninthcomputerclass->computerpracticalmarks = $request->computerpracticalmarks;
         $ninthcomputerclass->totalcomputermarks = $request->computertheorymarks + $request->computerpracticalmarks;
         $ninthcomputerclass->totalchemistrymarks = $request->chemistrytheorymarks + $request->chemistrypracticalmarks;
         $ninthcomputerclass->totalmarks = $totalmarks;
         $ninthcomputerclass->overallpercentage = $percent;
         $ninthcomputerclass->englishpercentage = $englishpercent;
         $ninthcomputerclass->sindhipercentage = $sindhipercent;
         $ninthcomputerclass->pakistanstudiespercentage = $pakistanstudiespercent;
         $ninthcomputerclass->chemistrypercentage = $chemistrypercent;
         $ninthcomputerclass->computerpercentage = $computerpercent;
         $ninthcomputerclass->grade = $grade;
         $ninthcomputerclass->totalclearedpaper = $clearedsubject;
         $ninthcomputerclass->examtype = 'Annual';
         $ninthcomputerclass->passingstatus = $passingstatus;                       
         $ninthcomputerclass->enrollmentnumber = $uniquekey;
         $ninthcomputerclass->save();            

    }



    public function bulkinsert(Request $request){
        error_log($request);
        $data = $request->json()->all();
        $formattedarray = [];
        
        foreach( $data as $items){
             
            error_log("Items"); 
            $now = Carbon::now('utc')->toDateTimeString();
            $schoolid = School::firstOrCreate(['schoolname'=> $items['schoolname']]);
            error_log($schoolid);
            $uniquekey = $items['enrollmentnumber'].$items['yearofappearing'];
            $studentid = Student::firstorCreate(['ninthexamuniquekey'=> $uniquekey],['studentname'=> $items['studentname'],'fathername'=> $items['fathername'],'schoolid'=> $schoolid['id'],'enrollmentnumber'=> $items['enrollmentnumber'],'dateofbirth' => $items['dateofbirth'],'ninthexamuniquekey'=> $uniquekey]);




        if ($items['englishmarks'] == 'A'){
            $items['englishmarks'] = '';

           }

           if ($items['sindhimarks'] == 'A'){
            $items['sindhimarks'] = '';

           }

           if ($items['pakistanstudiesmark'] == 'A'){
           // error_log($items['pakistanstudiesmark']);

            $data = json_decode($items['pakistanstudiesmark'], true);
            $data['pakistanstudiesmark'] = "";
            $items['pakistanstudiesmark'] = json_encode($data);

           }


            if ($items['chemistrytheorymarks'] == 'A'){
                $items['chemistrytheorymarks'] = '';

           }


            if ($items['chemistrypracticalmarks'] == 'A'){
                $items['chemistrypracticalmarks'] = '';

           }


            if ($items['computertheorymarks'] == 'A'){
                $items['computertheorymarks'] = '';

           }



            if ($items['computerpracticalmarks'] == 'A'){
                $items['computerpracticalmarks'] = '';

           }

          // error_log($items['pakistanstudiesmark']);

            $totalmarks = $items['englishmarks']+ $items['sindhimarks']+ $items['pakistanstudiesmark']+ $items['chemistrytheorymarks']+$items['chemistrypracticalmarks']+$items['computertheorymarks']+$items['computerpracticalmarks'] ;

            $computertotalmarks = $items['computertheorymarks'] + $items['computerpracticalmarks'] ;
            $chemistrytotalmarks = $items['chemistrytheorymarks']+$items['chemistrypracticalmarks'];
            $percent = $totalmarks/425 *100;
            $englishpercent =$items['englishmarks']/75 *100 ;
            $sindhipercent = $items['sindhimarks']/75 *100 ;
            $pakistanstudiespercent = $items['pakistanstudiesmark']/75 *100 ;
            $chemistrypercent = ($items['chemistrytheorymarks'] + $items['chemistrypracticalmarks'])/100 *100;;
            $computerpercent =  $computertotalmarks/100 *100 ;

            $percentarray = array($englishpercent,$sindhipercent,$pakistanstudiespercent,$chemistrypercent,$computerpercent);

         
         
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
                 'computertheorymarks' => $items['computertheorymarks'] ?? 'A',
                 'computerpracticalmarks' => $items['computerpracticalmarks'] ?? 'A',
                 'totalcomputermarks' => $computertotalmarks,
                 'totalchemistrymarks' => $chemistrytotalmarks,
                 'totalmarks' => $totalmarks,
                 'overallpercentage' => $percent,
                 'englishpercentage' => $englishpercent,
                 'sindhipercentage' => $sindhipercent,
                 'pakistanstudiespercentage' => $pakistanstudiespercent,
                 'chemistrypercentage' => $chemistrypercent,
                 'computerpercentage'=> $computerpercent,
                 'grade' => $grade,
                 'totalclearedpaper' => $clearedsubject,
                 'examtype' => 'Annual',
                 'passingstatus' => $passingstatus,
                 'enrollmentnumber' => $uniquekey,
                 'created_at' => $now,
                 'updated_at' => $now
             ];


        } 
        Ninthziauddinboardcomputer::insert($formattedarray);
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
     * @param  \App\Ninthziauddinboardcomputer  $ninthziauddinboardcomputer
     * @return \Illuminate\Http\Response
     */
    public function show(Ninthziauddinboardcomputer $ninthziauddinboardcomputer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ninthziauddinboardcomputer  $ninthziauddinboardcomputer
     * @return \Illuminate\Http\Response
     */
    public function edit(Ninthziauddinboardcomputer $ninthziauddinboardcomputer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ninthziauddinboardcomputer  $ninthziauddinboardcomputer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ninthziauddinboardcomputer $ninthziauddinboardcomputer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ninthziauddinboardcomputer  $ninthziauddinboardcomputer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ninthziauddinboardcomputer $ninthziauddinboardcomputer)
    {
        //
    }
}
