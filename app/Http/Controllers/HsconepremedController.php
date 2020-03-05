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
    public function preMedCalc($request,$data){
        if (isset($request['schoolid'])){
            $schoolid = $request["schoolid"];
        }else if (isset($request['schoolname'])) {
            $school = School::firstorCreate(['schoolname'=> $request["schoolname"]]);
            $schoolid = $school['id'];
        }
        $firstyearexamuniquekey = $request['enrollmentnumber'].$request['yearappearing'];
        $studentid = Student::firstorCreate(['firstyearexamuniquekey'=> $firstyearexamuniquekey],['studentname'=> $request['studentname'],'fathername'=> $request['fathername'],'schoolid'=> $schoolid,'enrollmentnumber'=> $request['enrollmentnumber'],'dateofbirth' => '1995','firstyearexamuniquekey'=> $firstyearexamuniquekey]);
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
        $data['totalmarks'] = $mandatorySubjectsTotal + $physicsTotal + $chemTotal + $bioTotal;
        $data['percentage'] = $this->gradeService->getPercentage($data['totalmarks'],550);
        $data['grade'] = $this->gradeService->gradecalculation($data['totalmarks']);
        $data['totalclearedpaper'] = $passedCount;
        $data['enrollmentnumber'] = $firstyearexamuniquekey;
        return $data;
    }
    public function create(Request $request)
    {
        $data = $request->except(['schoolname','studentname','fathername','enrollmentnumber']);
        $data = $this->preMedCalc($request,$data);
        $studentrecord = Hsconepremed::create($data);

        return $studentrecord;
    }
    public function bulkrecordinsert(Request $request)
    {
        $response = $request->json()->all();
        $formattedarray = [];
        foreach( $response as $data){
            $now = Carbon::now('utc')->toDateTimeString();
            $data = $this->preMedCalc($data,$data);
            $data['created_at'] = $now;
            $data['updated_at'] = $now;

            $formattedarray[]=[
                'englishmarks' => $data['englishmarks'] ?? 'A',
                'urdumarks' => $data['urdumarks'] ?? 'A',
                'islamiatmarks' => $data['islamiatmarks'] ?? 'A',
                'chemistrytheorymarks' => $data['chemistrytheorymarks']?? 'A',
                'chemistrypracticalmarks' => $data['chemistrypracticalmarks']?? 'A',
                'zoologymarks' => $data['zoologymarks']?? 'A',
                'botanymarks' => $data['botanymarks']?? 'A',
                'physicspracticalmarks' => $data['physicspracticalmarks'] ?? 'A',
                'physicspracticalmarks' => $data['physicspracticalmarks'] ?? 'A',
                'yearappearing' => $data['yearappearing'] ?? '',
                'totalmarks' => $data['totalmarks'],
                'percentage' => $data['percentage'],
                'grade' => $data['grade'],
                'totalclearedpaper' => $data['totalclearedpaper'],
                'enrollmentnumber' => $data['enrollmentnumber'],
                'created_at' => $now,
                'updated_at' => $now
            ];
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
        $user->studentname = $request['studentinfo']['studentname'];
        $user->fathername = $request['studentinfo']['fathername'];
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

        unset($data['studentinfo']);
        Hsconepremed::where('id', $data['id'])->update($data);

        return response()->json([
            'success'   =>  true,
            'data' => $data
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
