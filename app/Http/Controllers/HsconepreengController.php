<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hsconepreeng;
use App\School;
use Carbon\Carbon;
use App\Student;
class HsconepreengController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Hsconepreeng::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function preEngCalc($request,$data){
        if (isset($request['schoolid'])){
            $schoolid = $request["schoolid"];
        }else if (isset($request['schoolname'])) {
            $school = School::firstorCreate(['schoolname'=> $request["schoolname"]]);
            $schoolid = $school['id'];
        }
        $firstyearexamuniquekey = $data['enrollmentnumber'].$data['yearofappearing'];
        $studentid = Student::firstorCreate(['firstyearexamuniquekey'=> $firstyearexamuniquekey],['studentname'=> $request['studentname'],'fathername'=> $request['fathername'],'schoolid'=> $schoolid,'enrollmentnumber'=> $request['enrollmentnumber'],'dateofbirth' => $request['dateofbirth'],'firstyearexamuniquekey'=> $firstyearexamuniquekey]);
        $mandatorySubjectsTotal =$this->gradeService->totalOfMandatorySubjects($request->all());
        $physicsTotal = $data['physicspracticalmarks'] + $data['physicstheorymarks'];
        $chemTotal = $data['chemistrytheorymarks'] + $data['chemistrypracticalmarks'];
        $mathTotal=  $data['mathmarks'];
        $engPercent = $this->gradeService->getPercentage($data['englishmarks'],100);
        $urduPercent = $this->gradeService->getPercentage($data['urdumarks'],100);
        $islPercent = $this->gradeService->getPercentage($data['islamiatmarks'],50);
        $physicsPercent = $this->gradeService->getPercentage($physicsTotal,100);
        $chemPercent = $this->gradeService->getPercentage($chemTotal,100);
        $mathPercent = $this->gradeService->getPercentage($mathTotal,100);
        $passedSubjects = $this->gradeService->passedSubjects([$engPercent,$urduPercent,$islPercent,$physicsPercent,$chemPercent,$mathPercent]);
        $passedCount= count($passedSubjects);
        $data['totalmarks'] = $mandatorySubjectsTotal + $physicsTotal + $chemTotal + $mathPercent;
        $data['percentage'] = $this->gradeService->getPercentage($data['totalmarks'],550);
        $data['grade'] = $this->gradeService->gradecalculation($data['totalmarks']);
        $data['totalclearedpaper'] = $passedCount;
        $data['enrollmentnumber'] = $firstyearexamuniquekey;
        return $data;

    }
    public function create(Request $request)
    {
        $data = $request->except(['schoolname','studentname','fathername','enrollmentnumber']);
        $data = $this->preEngCalc($request,$data);
        $studentrecord = Hsconepreeng::create($data);
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
                'mathmarks' => $data['mathmarks']?? 'A',
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
        Hsconepreeng::insert($formattedarray);
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
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user =  Student::find($request['studentinfo']['id']);
        $user->studentname = $request['studentinfo']['studentname'];
        $user->fathername = $request['studentinfo']['fathername'];
        $user->save();

        $mandatorySubjectsTotal =$this->gradeService->totalOfMandatorySubjects($request->all());
        $physicsTotal = $data['physicspracticalmarks'] + $data['physicstheorymarks'];
        $chemTotal = $data['chemistrytheorymarks'] + $data['chemistrypracticalmarks'];
        $mathTotal=  $data['mathmarks'];
        $engPercent = $this->gradeService->getPercentage($data['englishmarks'],100);
        $urduPercent = $this->gradeService->getPercentage($data['urdumarks'],100);
        $islPercent = $this->gradeService->getPercentage($data['islamiatmarks'],50);
        $physicsPercent = $this->gradeService->getPercentage($physicsTotal,100);
        $chemPercent = $this->gradeService->getPercentage($chemTotal,100);
        $mathPercent = $this->gradeService->getPercentage($mathTotal,100);

        $passedSubjects = $this->gradeService->passedSubjects([$engPercent,$urduPercent,$islPercent,$physicsPercent,$chemPercent,$mathPercent]);
        $passedCount= count($passedSubjects);
        $data['totalmarks'] = $mandatorySubjectsTotal + $physicsTotal + $chemTotal + $mathTotal;
        $data['percentage'] = $this->gradeService->getPercentage($data['totalmarks'],550);
        $data['grade'] = $this->gradeService->gradecalculation($data['totalmarks']);

        $data['totalclearedpaper'] = $passedCount;

        unset($data['studentinfo']);
        Hsconepreeng::where('id', $data['id'])->update($data);

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
    public function destroy($id)
    {
        //
    }
}
