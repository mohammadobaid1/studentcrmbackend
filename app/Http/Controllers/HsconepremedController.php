<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hsconepremed;
use App\Services\GradeService;
use App\School;
use Carbon\Carbon;
use App\Student;
class HsconepremedController extends Controller
{
    public $gradeService;
   

    public function __construct(GradeService $gradeService){
        $this->gradeService = $gradeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Hsconepremed::with('studentinfo.schoolname')->get();
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
        $school = School::firstorCreate(['schoolname'=> $request["schoolname"]]);
         
        $schoolid = $school['id'];
        

        }



        //$schoolname = $request->schoolname;


        $data = $request->except(['schoolname','studentname','studentfathername','studentrollnumber']);
        


        // $school = School::firstorCreate(['schoolname' =>$schoolname]);
        



        $firstyearexamuniquekey = $request['studentrollnumber'].$request['yearappearing'];
        $studentid = Student::firstorCreate(['firstyearexamuniquekey'=> $firstyearexamuniquekey],['studentname'=> $request['studentname'],'fathername'=> $request['studentfathername'],'schoolid'=> $schoolid,'enrollmentnumber'=> $request['studentrollnumber'],'dateofbirth' => '1995','firstyearexamuniquekey'=> $firstyearexamuniquekey]);
        $mandatorySubjectsTotal =$this->gradeService->totalOfMandatorySubjects($request->all());
        $physicsTotal = $data['physicspracticalmarks'] + $data['physicstheorymarks'];
        $chemTotal = $data['chemistrytheorymarks'] + $data['chemistrypracticalmarks'];
        $bioTotal=  $data['zoologymarks'] + $data['botanymarks'];
        $engPercent = $this->gradeService->getPercentage($data['englishmarks'],100);
        $urduPercent = $this->gradeService->getPercentage($data['urdumarks'],100);
        $islPercent = $this->gradeService->getPercentage($data['islamiatmarks'],50);
        $physicsPercent = $this->gradeService->getPercentage($physicsTotal,100);
        $chemPercent = $this->gradeService->getPercentage($chemTotal,100);
        $bioPercent = $this->gradeService->getPercentage($bioTotal,100);

        $passedSubjects = $this->gradeService->passedSubjects([$engPercent,$urduPercent,$islPercent,$physicsPercent,$chemPercent,$bioPercent]);
        $passedCount= count($passedSubjects);
        $data['schoolid'] = $schoolid;
        $data['totalmarks'] = $mandatorySubjectsTotal + $physicsTotal + $chemTotal + $bioTotal;
        $data['percentage'] = $this->gradeService->getPercentage($data['totalmarks'],550);
        $data['grade'] = $this->gradeService->gradecalculation($data['totalmarks']);

        $data['totalclearedpaper'] = $passedCount;
        $data['enrollmentnumber'] = $firstyearexamuniquekey;
        $studentrecord = Hsconepremed::create($data);

        return $studentrecord;
    }
    public function bulkrecordinsert(Request $request)
    {

        error_log($request);
        $response = $request->json()->all();
        $formattedarray = [];
        foreach( $response as $data){
            $now = Carbon::now('utc')->toDateTimeString();
            $school = School::firstOrCreate(['schoolname'=> $data['schoolname']]);
            $firstyearexamuniquekey = $data['enrollmentnumber'].$data['yearappearing'];
            $studentid = Student::firstorCreate(['firstyearexamuniquekey'=> $firstyearexamuniquekey],['studentname'=> $data['studentname'],'fathername'=> $data['fathername'],'schoolid'=> $school['id'],'enrollmentnumber'=> $data['enrollmentnumber'],'dateofbirth' => $data['dateofbirth'],'firstyearexamuniquekey'=> $firstyearexamuniquekey]);
            $mandatorySubjectsTotal =$this->gradeService->totalOfMandatorySubjects($data);
            $physicsTotal = $data['physicspracticalmarks'] + $data['physicstheorymarks'];
            $chemTotal = $data['chemistrytheorymarks'] + $data['chemistrypracticalmarks'];
            $bioTotal=  $data['zoologymarks'] + $data['botanymarks'];
            
            $engPercent = $this->gradeService->getPercentage($data['englishmarks'],100);
            $urduPercent = $this->gradeService->getPercentage($data['urdumarks'],100);
            $islPercent = $this->gradeService->getPercentage($data['islamiatmarks'],50);
            $physicsPercent = $this->gradeService->getPercentage($physicsTotal,100);
            $chemPercent = $this->gradeService->getPercentage($chemTotal,100);
            $bioPercent = $this->gradeService->getPercentage($bioTotal,100);

            $passedSubjects = $this->gradeService->passedSubjects([$engPercent,$urduPercent,$islPercent,$physicsPercent,$chemPercent,$bioPercent]);
            $passedCount= count($passedSubjects);
            $data['schoolid'] = $school['id'];
            $data['totalmarks'] = $mandatorySubjectsTotal + $physicsTotal + $chemTotal + $bioTotal;
            $data['percentage'] = $this->gradeService->getPercentage($data['totalmarks'],550);
            $data['grade'] = $this->gradeService->gradecalculation($data['totalmarks']);

            $data['totalclearedpaper'] = $passedCount;
            $data['enrollmentnumber'] = $firstyearexamuniquekey;


            $data['created_at'] = $now;
            $data['updated_at'] = $now;
            $formattedarray[]= $data;
        }
        Hsconepremed::insert($formattedarray);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $user =  Student::find($request['studentinfo']['id']);
        $user->studentname = $request['studentname'];
        $user->fathername = $request['fathername'];
        $user->save();

        $mandatorySubjectsTotal =$this->gradeService->totalOfMandatorySubjects($request->all());
        $physicsTotal = $data['physicspracticalmarks'] + $data['physicstheorymarks'];
        $chemTotal = $data['chemistrytheorymarks'] + $data['chemistrypracticalmarks'];
        $bioTotal=  $data['zoologymarks'] + $data['botanymarks'];
        $engPercent = $this->gradeService->getPercentage($data['englishmarks'],100);
        $urduPercent = $this->gradeService->getPercentage($data['urdumarks'],100);
        $islPercent = $this->gradeService->getPercentage($data['islamiatmarks'],50);
        $physicsPercent = $this->gradeService->getPercentage($physicsTotal,100);
        $chemPercent = $this->gradeService->getPercentage($chemTotal,100);
        $bioPercent = $this->gradeService->getPercentage($bioTotal,100);

        $passedSubjects = $this->gradeService->passedSubjects([$engPercent,$urduPercent,$islPercent,$physicsPercent,$chemPercent,$bioPercent]);
        $passedCount= count($passedSubjects);
        $data['totalmarks'] = $mandatorySubjectsTotal + $physicsTotal + $chemTotal + $bioTotal;
        $data['percentage'] = $this->gradeService->getPercentage($data['totalmarks'],550);
        $data['grade'] = $this->gradeService->gradecalculation($data['totalmarks']);

        $data['totalclearedpaper'] = $passedCount;
        $studentrecord = Hsconepremed::create($data);

        return response()->json([
            'success'   =>  true,
            'data' => $studentrecord
        ], 200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $examData = Hsconepremed::find($request['id']);
        $user = Student::find($request['studentinfo']['id']);
        $examData->delete();
        $user->delete();
        return response()->json([
            'success'   =>  true,
            'data' => $examData
        ], 200);

    }
}
