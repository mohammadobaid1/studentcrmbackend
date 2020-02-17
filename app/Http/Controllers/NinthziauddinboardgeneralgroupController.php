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


    public function search(Request $request){

        error_log($request);
        
        $studentname = $request->studentname;
        $fathername = $request->fathername;
        $rollnumber = $request->enrollmentnumber;
        $schoolname = $request->schoolname;

        
        $wherearray=['students.studentname'=>$studentname,'students.fathername'=> $fathername,'students.enrollmentnumber'=>$rollnumber];

        $schoolid = School::where('schoolname',$schoolname)->value('id');
 
        error_log($schoolid);

         $userdata = Student::with('schoolname')->with('ninthgeneraldata')->where('studentname',$studentname)->orWhere('enrollmentnumber',$rollnumber)->orWhere('fathername',$fathername)->orWhere('schoolid',$schoolid)->get();

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
        else {
        $school = School::firstorCreate(['schoolname'=> 'Private']);
         
        $schoolid = $school['id'];
        error_log($schoolid);
    }


      if ($request['group'] == 'Private'){
        $school = School::firstorCreate(['schoolname'=> 'Private']);
        $schoolid = $school['id'];

      }
        


        $uniquekey = $request['enrollmentnumber'].$request['yearofappearing'];

        $studentid = Student::firstorCreate(['ninthexamuniquekey'=> $uniquekey],['studentname'=> $request['studentname'],'fathername'=> $request['fathername'],'schoolid'=> $schoolid,'enrollmentnumber'=> $request['enrollmentnumber'],'dateofbirth' => $request['dateofbirth'],'ninthexamuniquekey'=> $uniquekey]);


        if ($items['englishmarks'] == 'A'){
            $items['englishmarks'] = '';

           }

           if ($items['sindhimarks'] == 'A'){
            $items['sindhimarks'] = '';

           }

           if ($items['pakistanstudiesmark'] == 'A'){
            $items['pakistanstudiesmark'] = '';

           }


            if ($items['generalsciencemarks'] == 'A'){
                $items['generalsciencemarks'] = '';

           }


            if ($items['mathsmarks'] == 'A'){
                $items['mathsmarks'] = '';

           }





        $totalmarks = $request['englishmarks']+ $request['sindhimarks']+ $request['pakistanstudiesmark']+ $request['generalsciencemarks']+$request['mathsmarks'] ;

       


         $percent = $totalmarks/425 *100;
         $englishpercent =$request['englishmarks']/75 *100 ;
         $sindhipercent = $request['sindhimarks']/75 *100 ;
         $pakistanstudiespercent = $request['pakistanstudiesmark']/75 *100 ;
         $generalsciencepercent = $request->generalsciencemarks/100 *100;
         $mathspercent = $request->mathsmarks/100 *100;
       
         $percentarray = array($englishpercent,$sindhipercent,$pakistanstudiespercent,$generalsciencepercent,$mathspercent);

        

         $grade = $this->gradecalculation($totalmarks);


        $passarray = array_filter($percentarray,array($this,'checkpassstatus'));

       
         

         $clearedsubject = count($passarray);

         $passingstatus = 'pass';

         if ($clearedsubject < 5){
            $passingstatus = 'failed';
         }

         $ninthgeneralclass =  new Ninthziauddinboardgeneralgroup();

         $ninthgeneralclass->englishmarks = $request->englishmarks;
         $ninthgeneralclass->sindhimarks = $request->sindhimarks;
         $ninthgeneralclass->pakistanstudiesmark = $request->pakistanstudiesmark;
         $ninthgeneralclass->generalsciencemarks = $request->generalsciencemarks;
         $ninthgeneralclass->mathsmarks = $request->mathsmarks;
         $ninthgeneralclass->totalmarks = $totalmarks;
         $ninthgeneralclass->overallpercentage = $percent;
         $ninthgeneralclass->englishpercentage = $englishpercent;
         $ninthgeneralclass->sindhipercentage = $sindhipercent;
         $ninthgeneralclass->pakistanstudiespercentage = $pakistanstudiespercent;
         $ninthgeneralclass->generalsciencepercentage = $generalsciencepercent;
         $ninthgeneralclass->mathspercentage = $mathspercent;
         $ninthgeneralclass->grade = $grade;
         $ninthgeneralclass->totalclearedpaper = $clearedsubject;
         $ninthgeneralclass->examtype = 'Annual';
         $ninthgeneralclass->passingstatus = $passingstatus;
         $ninthgeneralclass->group = $request['group'];                       
         $ninthgeneralclass->enrollmentnumber = $uniquekey;
         $ninthgeneralclass -> save();
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


    public function bulkinsert(Request $request)
    {
        //


                error_log($request);
        $data = $request->json()->all();
        $formattedarray = [];
        
        foreach( $data as $items){
             
            error_log("Items"); 
            $now = Carbon::now('utc')->toDateTimeString();


            if ($items['schoolname']) {
                     error_log("here1");   
                    $schoolid = School::firstorCreate(['schoolname'=> $items["schoolname"]]);
                    //$schoolid = $school['id'];
                    error_log($schoolid);

        } 
        else {
            $schoolid = School::firstOrCreate(['schoolname'=> 'Private']);
            error_log($schoolid);
        }

           $uniquekey = $items['enrollmentnumber'].$items['yearofappearing'];


            $studentid = Student::firstorCreate(['ninthexamuniquekey'=> $uniquekey],['studentname'=> $items['studentname'],'fathername'=> $items['fathername'],'schoolid'=> $schoolid['id'],'enrollmentnumber'=> $items['enrollmentnumber'],'dateofbirth' => $items['dateofbirth'],'ninthexamuniquekey'=> $uniquekey]);


          $totalmarks = $items['englishmarks']+ $items['sindhimarks']+ $items['pakistanstudiesmark']+ $items['generalsciencemarks']+$items['mathsmarks'] ;


            
            $percent = $totalmarks/425 *100;
            $englishpercent =$items['englishmarks']/75 *100 ;
            $sindhipercent = $items['sindhimarks']/75 *100 ;
            $pakistanstudiespercent = $items['pakistanstudiesmark']/75 *100 ;
            $generalsciencepercent = $items['generalsciencemarks']/100 *100;
            $mathspercent = $items['mathsmarks']/100 *100;
       
            $percentarray = array($englishpercent,$sindhipercent,$pakistanstudiespercent,$generalsciencepercent,$mathspercent);

           

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
                 'generalsciencemarks' => $items['generalsciencemarks']?? 'A',
                 'mathsmarks' => $items['mathsmarks']?? 'A',
                 'totalmarks' => $totalmarks,
                 'overallpercentage' => $percent,
                 'englishpercentage' => $englishpercent,
                 'sindhipercentage' => $sindhipercent,
                 'pakistanstudiespercentage' => $pakistanstudiespercent,
                 'generalsciencepercentage' => $generalsciencepercent,
                 'mathspercentage'=> $mathspercent,
                 'grade' => $grade,
                 'totalclearedpaper' => $clearedsubject,
                 'examtype' => 'Annual',
                 'passingstatus' => $passingstatus,
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
