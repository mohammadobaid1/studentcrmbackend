<?php

namespace App\Http\Controllers;

use App\Matricziauddingeneral;
use Illuminate\Http\Request;
use App\Student;
use App\School;

class MatricziauddingeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Matricziauddingeneral::with('studentinfo.schoolname')->get();
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
      

      $school = School::firstorCreate(['schoolname'=> 'Private']);
         
        $schoolid = $school['id'];
        error_log($schoolid);



      $uniquematricenrollmentkey = $request['matricenrollmentnumber'].$request['yearofappearing']; 

       if ($request->id) {
        Student::where('id',$request->id)->update(array('matricenrollmentnumber' => $request['matricenrollmentnumber'],'matricexamuniquekey' => $uniquematricenrollmentkey,'schoolid'=>$schoolid ));

       }

       else {
       
         $studentid = Student::firstorCreate(['matricexamuniquekey'=> $uniquematricenrollmentkey],['studentname'=> $request['studentname'],'fathername'=> $request['fathername'],'schoolid'=> $schoolid,'matricenrollmentnumber'=> $request['matricenrollmentnumber'],'dateofbirth' => $request['dateofbirth'],'matricexamuniquekey'=> $uniquematricenrollmentkey,'schoolid'=>$schoolid ]);
 
        }


        $optionalsubjectstotalmarks = $request['islamicstudies']+$request['commerce']+$request['geography']+$request['civics']+$request['economics'];


        $optionalsubjectarray = [];
        if(!empty($request['islamicstudies'])) {
            array_push($optionalsubjectarray,$request['islamicstudies']);
        }

        if(!empty($request['commerce'])) {
            array_push($optionalsubjectarray,$request['commerce']);
        }

        if(!empty($request['geography'])) {
            array_push($optionalsubjectarray,$request['geography']);
        }

        if(!empty($request['civics'])) {
            array_push($optionalsubjectarray,$request['civics']);
        }

        if(!empty($request['economics'])) {
            array_push($optionalsubjectarray,$request['economics']);
        }


        $islamiatethicsmarks = $request['islamiatmarks']+$request['ethicsmarks'];

        $totalmarks = $request['englishmarks']+ $request['urdumarks'] + $islamiatethicsmarks+ $optionalsubjectstotalmarks;

        if ($request['islamiatmarks']){
            $optionlcode = 1;
        }

        if ($request['ethicsmarks']){
            $optionlcode = 0;
        }

            $percent = $totalmarks/425 *100;

            $englishpercent = $request['englishmarks']/75 * 100;
            $urdupercent = $request['urdumarks']/75 *100;
            $islamiatethicspercent = $islamiatethicsmarks/75 *100;
            $optionalsubjectpercent = $optionalsubjectstotalmarks/200 * 100;
            

            $percentarray = array($englishpercent,$urdupercent,$islamiatethicspercent);

        

         $grade = $this->gradecalculation($percent);


        $passarray = array_filter($percentarray,array($this,'checkpassstatus'));
        $optionalpassarray = array_filter($optionalsubjectarray,array($this,'checkpassstatus'));
         

         $clearedsubject = count($passarray)+count($optionalpassarray);

         $passingstatus = 'pass';

         if ($clearedsubject < 5){
            $passingstatus = 'failed';
         }

         $matricgeneralclass =  new Matricziauddingeneral();

         $matricgeneralclass->EnglishMarks = $request->englishmarks ?? 'A';
         $matricgeneralclass->UrduMarks = $request->urdumarks ?? 'A';
         $matricgeneralclass->IslamiatorethicsMarks = $islamiatethicsmarks?? 'A';
         $matricgeneralclass->CommerceMarks = $islamiatethicsmarks ;
         $matricgeneralclass->IslamicstudiesMarks = $islamiatethicsmarks ;
         $matricgeneralclass->GeographyMarks = $islamiatethicsmarks ;
         $matricgeneralclass->CivicsMarks = $islamiatethicsmarks ;
         $matricgeneralclass->EconomicsMarks = $islamiatethicsmarks ;
         $matricgeneralclass->TotalMarks = $totalmarks;
         $matricgeneralclass->OverallPercentage = $percent;
         $matricgeneralclass->PassingStatus = $passingstatus;
         $matricgeneralclass->EnglishPercentage = $englishpercent;
         $matricgeneralclass->UrduPercentage = $urdupercent;
         $matricgeneralclass->IslamiatorethicsPercentage = $islamiatethicspercent;
         $matricgeneralclass->Optionalsubjectspercentage = $optionalsubjectpercent;
         $matricgeneralclass->OverallPercentage = $percent;
         $matricgeneralclass->Totalclearedpaper = $clearedsubject;   
         $matricgeneralclass->grade = $grade;                      
         $matricgeneralclass->enrollmentnumberunique = $uniquematricenrollmentkey;
         $matricgeneralclass->examtype = $request['examtype']; 
         $matricgeneralclass->OptionalSubjectCode = $optionlcode;
         $matricgeneralclass->grouptype  = $request['group'];            
         $matricgeneralclass -> save();


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

        $data = $request->json()->all();
        $formattedarray = [];

        foreach( $data as $items){
             
           
            $now = Carbon::now('utc')->toDateTimeString();
            $schoolid = School::firstOrCreate(['schoolname'=> 'Private']);
            
        $uniquematricenrollmentkey = $items['matricenrollmentnumber'].$items['yearofappearing']; 


            if ($items->ninthenrollmentnumber) {
            Student::where('enrollmentnumber',$items->ninthenrollmentnumber)->update(array('matricenrollmentnumber' => $items->matricrollnumber,'matricexamuniquekey' => $uniquematricenrollmentkey,'schoolid'=>$schoolid));

       }


        else {
       
            $studentid = Student::firstorCreate(['matricexamuniquekey'=> $uniquematricenrollmentkey],['studentname'=> $items['studentname'],'fathername'=> $items['fathername'],'schoolid'=> $schoolid,'matricenrollmentnumber'=> $items['matricrollnumber'],'dateofbirth' => $items['dateofbirth'],'matricexamuniquekey'=> $uniquematricenrollmentkey,'schoolid'=>$schoolid ]);
     
           }    

            $islamiatethicsmarks = $items['islamiatmarks']+$items['ethicsmarks'];

            $totalmarks = $items['englishmarks']+ $items['urdumarks']+ $islamiatethicsmarks;

            if ($items['islamiatmarks']){
                $optionlcode = 1;
            }

            if ($items['ethicsmarks']){
                $optionlcode = 0;
            }


    $optionalsubjectstotalmarks = $items['islamicstudies']+$items['commerce']+$items['geography']+$items['civics']+$items['economics'];


        $optionalsubjectarray = [];
        if(!empty($items['islamicstudies'])) {
            array_push($optionalsubjectarray,$items['islamicstudies']);
        }

        if(!empty($items['commerce'])) {
            array_push($optionalsubjectarray,$items['commerce']);
        }

        if(!empty($items['geography'])) {
            array_push($optionalsubjectarray,$items['geography']);
        }

        if(!empty($items['civics'])) {
            array_push($optionalsubjectarray,$items['civics']);
        }

        if(!empty($items['economics'])) {
            array_push($optionalsubjectarray,$items['economics']);
        }


            
            $percent = $totalmarks/425 *100;
            $englishpercent = $items['englishmarks']/75 * 100;
            $urdupercent = $items['urdumarks']/75 *100;
            $islamiatethicspercent = $islamiatethicsmarks/75 *100;
            $optionalsubjectpercent = $optionalsubjectstotalmarks/200 * 100;
            

            $percentarray = array($englishpercent,$urdupercent,$islamiatethicspercent);
            

            $grade = $this->gradecalculation($percent);
            $passarray = array_filter($percentarray,array($this,'checkpassstatus'));
            $optionalpassarray = array_filter($optionalsubjectarray,array($this,'checkpassstatus'));
            $clearedsubject = count($passarray)+ count($optionalpassarray);
            $passingstatus = 'pass';

            if ($clearedsubject < 5){
                $passingstatus = 'failed';
            }

            $formattedarray[]=[
                 'EnglishMarks' => $items['englishmarks'] ?? 'A',
                 'UrduMarks' => $items['urdumarks'] ?? 'A',
                 'IslamiatorethicsMarks' => $islamiatethicsmarks?? 'A',
                 'IslamicstudiesMarks' => $items['islamicstudies'],
                 'CommerceMarks' => $items['commerce'],
                 'GeographyMarks' => $items['geography'],
                 'CivicsMarks' => $items['civics'],
                 'EconomicsMarks' => $items['economics'],
                 'TotalMarks' => $totalmarks,
                 'OverallPercentage'=> $percent,
                 'PassingStatus' => $passingstatus,
                 'EnglishPercentage' => $englishpercent,
                 'UrduPercentage' => $urdupercent,
                 'IslamiatorethicsPercentage' => $islamiatethicspercent,
                 'Optionalsubjectspercentage'=> $optionalsubjectpercent,
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
     * @param  \App\Matricziauddingeneral  $matricziauddingeneral
     * @return \Illuminate\Http\Response
     */
    public function show(Matricziauddingeneral $matricziauddingeneral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Matricziauddingeneral  $matricziauddingeneral
     * @return \Illuminate\Http\Response
     */
    public function edit(Matricziauddingeneral $matricziauddingeneral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Matricziauddingeneral  $matricziauddingeneral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matricziauddingeneral $matricziauddingeneral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Matricziauddingeneral  $matricziauddingeneral
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matricziauddingeneral $matricziauddingeneral)
    {
        //
    }
}
