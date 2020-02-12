<?php

namespace App\Http\Controllers;

use App\Matricziauddinscience;
use Illuminate\Http\Request;
use App\Student;
use App\School;
use Carbon\Carbon;

class MatricziauddinscienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data = Matricziauddinscience::with('studentinfo.schoolname')->get();
        return $data;
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

        };


       $uniquematricenrollmentkey = $request['matricenrollmentnumber'].$request['yearofappearing']; 

       if ($request->id) {
        Student::where('id',$request->id)->update(array('matricenrollmentnumber' => $request['matricenrollmentnumber'],'matricexamuniquekey' => $uniquematricenrollmentkey,'schoolid'=>$schoolid ));

       }





       else {
       
        $studentid = Student::firstorCreate(['matricexamuniquekey'=> $uniquematricenrollmentkey],['studentname'=> $request['studentname'],'fathername'=> $request['fathername'],'schoolid'=> $schoolid,'matricenrollmentnumber'=> $request['matricenrollmentnumber'],'dateofbirth' => $request['dateofbirth'],'matricexamuniquekey'=> $uniquematricenrollmentkey,'schoolid'=>$schoolid ]);
 
        }

        $islamiatethicsmarks = $request['islamiatmarks']+$request['ethicsmarks'];

        $totalmarks = $request['englishmarks']+ $request['urdumarks']+ $request['mathsmark']+ $islamiatethicsmarks+$request['physicstheorymarks']+$request['physicspracticalmarks'];

        if ($request['islamiatmarks']){
            $optionlcode = 1;
        }

        if ($request['ethicsmarks']){
            $optionlcode = 0;
        }



        $totalphysicsmarks = $request['physicstheorymarks']+$request['physicspracticalmarks'];

        $percent = $totalmarks/425 *100;

            $englishpercent = $request['englishmarks']/75 * 100;
            $urdupercent = $request['urdumarks']/75 *100;
            $mathspercent = $request['mathsmark']/100 * 100;
            $islamiatethicspercent = $islamiatethicsmarks/75 *100;
            $physicspercent = $totalphysicsmarks/100 * 100;
            

            $percentarray = array($englishpercent,$urdupercent,$mathspercent,$islamiatethicspercent,$physicspercent);

        

         $grade = $this->gradecalculation($percent);


        $passarray = array_filter($percentarray,array($this,'checkpassstatus'));

       
         

         $clearedsubject = count($passarray);

         $passingstatus = 'pass';

         if ($clearedsubject < 5){
            $passingstatus = 'failed';
         }

         $matricscienceclass =  new Matricziauddinscience();

         $matricscienceclass->EnglishMarks = $request->englishmarks ?? 'A';
         $matricscienceclass->UrduMarks = $request->urdumarks ?? 'A';
         $matricscienceclass->MathsMarks = $request->mathsmark ?? 'A';
         $matricscienceclass->IslamiatorethicsMarks = $islamiatethicsmarks ?? 'A';
         $matricscienceclass->physicstheorymarks = $request->physicstheorymarks ?? 'A';
         $matricscienceclass->physicspracticalmarks = $physicspracticalmarks ?? 'A';
         $matricscienceclass->totalphysicsmarks = $totalphysicsmarks ;
         $matricscienceclass->TotalMarks = $totalmarks;
         $matricscienceclass->Percentage = $percent;
         $matricscienceclass->PassingStatus = $passingstatus;
         $matricscienceclass->EnglishPercentage = $englishpercent;
         $matricscienceclass->UrduPercentage = $urdupercent;
         $matricscienceclass->MathsPercentage = $mathspercent;
         $matricscienceclass->IslamiatorethicsPercentage = $islamiatethicspercent;
         $matricscienceclass->PhysicsPercentage = $physicspercent;
         $matricscienceclass->OverallPercentage = $percent;
         $matricscienceclass->Totalclearedpaper = $clearedsubject;   
         $matricscienceclass->grade = $grade;                      
         $matricscienceclass->enrollmentnumber = $uniquematricenrollmentkey;
         $matricscienceclass->examtype = $request['examtype']; 
         $matricscienceclass->OptionalSubjectCode = $optionlcode;            
         $matricscienceclass -> save();


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



    public function bulkinsert(Request $request){

        error_log($request);
        $data = $request->json()->all();
        $formattedarray = [];
        foreach( $data as $items){
             
            

            $now = Carbon::now('utc')->toDateTimeString();
            $schoolid = School::firstOrCreate(['schoolname'=> $items['schoolname']]);
            
        $uniquematricenrollmentkey = $items['matricenrollmentnumber'].$items['yearofappearing']; 


            if ($items['ninthenrollmentnumber']) {
            Student::where('enrollmentnumber',$items['ninthenrollmentnumber'])->update(array('matricenrollmentnumber' => $items['matricenrollmentnumber'],'matricexamuniquekey' => $uniquematricenrollmentkey,'schoolid'=>$schoolid->id));

       }


        else {
       
            $studentid = Student::firstorCreate(['matricexamuniquekey'=> $uniquematricenrollmentkey],['studentname'=> $items['studentname'],'fathername'=> $items['fathername'],'schoolid'=> $schoolid,'matricenrollmentnumber'=> $items['matricrollnumber'],'dateofbirth' => $items['dateofbirth'],'matricexamuniquekey'=> $uniquematricenrollmentkey,'schoolid'=>$schoolid ]);
     
           }    

            $islamiatethicsmarks = $items['islamiatmarks']+$items['ethicsmarks'];

            $totalmarks = $items['englishmarks']+ $items['urdumarks']+ $items['mathsmark']+ $islamiatethicsmarks+$items['physicstheorymarks']+$items['physicspracticalmarks'];

            if ($items['islamiatmarks']){
                $optionlcode = 1;
            }

            if ($items['ethicsmarks']){
                $optionlcode = 0;
            }



            $totalphysicsmarks = $items['physicstheorymarks']+$items['physicspracticalmarks'];
            $percent = $totalmarks/425 *100;
            $englishpercent = $items['englishmarks']/75 * 100;
            $urdupercent = $items['urdumarks']/75 *100;
            $mathspercent = $items['mathsmark']/100 * 100;
            $islamiatethicspercent = $islamiatethicsmarks/75 *100;
            $physicspercent = $totalphysicsmarks/100 * 100;
            $percentarray = array($englishpercent,$urdupercent,$mathspercent,$islamiatethicspercent,$physicspercent);
            $grade = $this->gradecalculation($percent);
            $passarray = array_filter($percentarray,array($this,'checkpassstatus'));
            $clearedsubject = count($passarray);
            $passingstatus = 'pass';

            if ($clearedsubject < 5){
                $passingstatus = 'failed';
            }

            $formattedarray[]=[
                 'EnglishMarks' => $items['englishmarks'] ?? 'A',
                 'UrduMarks' => $items['urdumarks'] ?? 'A',
                 'MathsMarks' => $items['mathsmark'] ?? 'A',
                 'IslamiatorethicsMarks' => $islamiatethicsmarks?? 'A',
                 'physicstheorymarks' => $items['physicstheorymarks']?? 'A',
                 'physicspracticalmarks' => $items['physicspracticalmarks'] ?? 'A',
                 'totalphysicsmarks' => $totalphysicsmarks,
                 'TotalMarks' => $totalmarks,
                 'PassingStatus' => $passingstatus,
                 'EnglishPercentage' => $englishpercent,
                 'UrduPercentage' => $urdupercent,
                 'MathsPercentage' => $mathspercent,
                 'IslamiatorethicsPercentage' => $islamiatethicspercent,
                 'PhysicsPercentage' => $physicspercent,
                 'OverallPercentage'=> $percent,
                 'grade' => $grade,
                 'Totalclearedpaper' => $clearedsubject,
                 'examtype' => $items['examtype'],
                 'PassingStatus' => $passingstatus,
                 'enrollmentnumber' => $uniquematricenrollmentkey,
                 'OptionalSubjectCode' => $optionlcode,
                 'created_at' => $now,
                 'updated_at' => $now
             ];


        } 
            Matricziauddinscience::insert($formattedarray);
                    return response()->json([
                            'success' => true
                    ]);



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
     * @param  \App\Matricziauddinscience  $matricziauddinscience
     * @return \Illuminate\Http\Response
     */
    public function show(Matricziauddinscience $matricziauddinscience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Matricziauddinscience  $matricziauddinscience
     * @return \Illuminate\Http\Response
     */
    public function edit(Matricziauddinscience $matricziauddinscience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Matricziauddinscience  $matricziauddinscience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matricziauddinscience $matricziauddinscience)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Matricziauddinscience  $matricziauddinscience
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matricziauddinscience $matricziauddinscience)
    {
        //
    }
}
