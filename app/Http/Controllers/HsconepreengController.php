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

        $data = $request->json()->all();
        $formattedarray = [];
        foreach( $data as $items){
            $now = Carbon::now('utc')->toDateTimeString();
            $schoolid = School::firstOrCreate(['schoolname'=> $items['schoolname']]);
            $totalmarks = $items['englishmarks'] + $items['urdumarks'] +
            $items['islamiatmarks'] +
            $items['physicspracticalmarks'] +
            $items['physicstheorymarks'] + $items['chemistrytheorymarks'] +
            $items['chemistrypracticalmarks'] + $items['mathmarks'];
            $percentage = ($totalmarks*550)/100;
            $items->totalmarks = $totalmarks;
            $items->percentage = $percentage;
            $items->schoolid = $schoolid['id'];
            $items->created_at = $now;
            $items->updated_at = $now;
             $formattedarray[]= $items;
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
        //
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
