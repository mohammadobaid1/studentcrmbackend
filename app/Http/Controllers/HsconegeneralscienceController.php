<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hsconegeneralscience;
use App\Services\GradeService;
use App\School;
use Carbon\Carbon;
use App\Student;
class HsconegeneralscienceController extends Controller
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
        return Hsconegeneralscience::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $schoolname = $request->schoolname;
        $data = $request->except('schoolname');
        $school = School::firstorCreate(['schoolname' =>$schoolname]);
        $firstyearexamuniquekey = $request['enrollmentnumber'].$request['yearofappearing'];
        $studentid = Student::firstorCreate(['firstyearexamuniquekey'=> $firstyearexamuniquekey],['studentname'=> $request['studentname'],'fathername'=> $request['fathername'],'schoolid'=> $school['id'],'enrollmentnumber'=> $request['enrollmentnumber'],'dateofbirth' => $request['dateofbirth'],'firstyearexamuniquekey'=> $firstyearexamuniquekey]);
        $mandatorySubjectsTotal =$this->gradeService->totalOfMandatorySubjects($request->all());
        $mathTotal = $data['mathmarks'];
        $compTotal = $data['computertheorymarks'] + $data['computerpracticalmarks'];
        $totalsArray = [$mandatorySubjectsTotal,$mathTotal,$compTotal];
        $engPercent = $this->gradeService->getPercentage($data['englishmarks'],100);
        $urduPercent = $this->gradeService->getPercentage($data['urdumarks'],100);
        $islPercent = $this->gradeService->getPercentage($data['islamiatmarks'],50);
        $mathPercent = $this->gradeService->getPercentage($mathTotal,100);
        $compPercent = $this->gradeService->getPercentage($compTotal,100);
        $percentArray = [$engPercent,$urduPercent,$islPercent,$mathPercent,$compPercent];
        if(isset($data['physicstheorymarks'])){
            $physicsTotal = $data['physicspracticalmarks'] + $data['physicstheorymarks'];
            $physicsPercent = $this->gradeService->getPercentage($physicsTotal,100);
            array_push($totalsArray, $physicsTotal);
            array_push($percentArray, $physicsPercent);
        }else if(isset($data['statstheorymarks'])){
            $statsTotal = $data['statstheorymarks'] + $data['statspracticalmarks'];
            $statsPercent = $this->gradeService->getPercentage($statsTotal,100);
            array_push($totalsArray, $statsTotal);
            array_push($percentArray, $statsPercent);
        }

        $passedSubjects = $this->gradeService->passedSubjects($percentArray);
        $passedCount= count($passedSubjects);
        $data['schoolid'] = $school['id'];
        $data['totalmarks'] = array_sum($totalsArray);
        $data['percentage'] = $this->gradeService->getPercentage($data['totalmarks'],550);
        $data['grade'] = $this->gradeService->gradecalculation($data['totalmarks']);

        $studentrecord = Hsconegeneralscience::create($data);
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
            $items['physicstheorymarks'] + $items['statspracticalmarks'] +
            $items['statstheorymarks'] + $items['computertheorymarks'] + $items['computerpracticalmarks'] +
            $items['mathmarks'];
            $percentage = ($totalmarks*700)/100;
            $grade = $this->gradeService->gradecalculation($percentage);
            $items->totalmarks = $totalmarks;
            $items->percentage = $percentage;
            $items->schoolid = $schoolid['id'];
            $items->created_at = $now;
            $items->updated_at = $now;
             $formattedarray[]= $items;
        }
        Hsconegeneralscience::insert($formattedarray);
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
