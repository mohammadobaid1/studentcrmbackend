<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hsconehumanities;
use App\Services\GradeService;
use App\School;
use Carbon\Carbon;
class HsconehumanitiesController extends Controller
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
        return Hsconehumanities::all();
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
        $mandatorySubjectsTotal =$this->gradeService->totalOfMandatorySubjects($request->all());
        $totalsArray = [$mandatorySubjectsTotal];
        $engPercent = $this->gradeService->getPercentage($data['englishmarks'],100);
        $urduPercent = $this->gradeService->getPercentage($data['urdumarks'],100);
        $islPercent = $this->gradeService->getPercentage($data['islamiatmarks'],50);
        $percentArray = [$engPercent,$urduPercent,$islPercent];
        if(isset($data['civicsmarks'])){
            $civicsTotal = $data['civicsmarks'];
            $civicsPercent = $this->gradeService->getPercentage($civicsTotal,100);
            array_push($totalsArray, $civicsTotal);
            array_push($percentArray, $civicsPercent);
        }else if(isset($data['sociologymarks'])){
            $sociologyTotal = $data['sociologymarks'];
            $sociologyPercent = $this->gradeService->getPercentage($sociologyTotal,100);
            array_push($totalsArray, $sociologyTotal);
            array_push($percentArray, $sociologyPercent);
        }
        if(isset($data['educationsmarks'])){
            $educationsTotal = $data['educationsmarks'];
            $educationsPercent = $this->gradeService->getPercentage($educationsTotal,100);
            array_push($totalsArray, $educationsTotal);
            array_push($percentArray, $educationsPercent);
        }else if(isset($data['islamichistorymarks'])){
            $islamichistoryTotal = $data['islamichistorymarks'];
            $islamichistoryPercent = $this->gradeService->getPercentage($islamichistoryTotal,100);
            array_push($totalsArray, $islamichistoryTotal);
            array_push($percentArray, $islamichistoryPercent);
        }
        if(isset($data['economicsmarks'])){
            $economicsTotal=  $data['economicsmarks'];
            $economicsPercent = $this->gradeService->getPercentage($economicsTotal,100);
            array_push($totalsArray, $economicsTotal);
            array_push($percentArray, $economicsPercent);

        }else if(isset($data['islamicstudiesmarks'])){
            $islamicstudiesTotal=  $data['islamicstudiesmarks'];
            $islamicstudiesPercent = $this->gradeService->getPercentage($islamicstudiesTotal,100);
            array_push($totalsArray, $islamicstudiesTotal);
            array_push($percentArray, $islamicstudiesPercent);
        }else if(isset($data['generalhistorymarks'])){
            $generalhistoryTotal=  $data['generalhistorymarks'];
            $generalhistoryPercent = $this->gradeService->getPercentage($generalhistoryTotal,100);
            array_push($totalsArray, $generalhistoryTotal);
            array_push($percentArray, $generalhistoryPercent);
        }

        $passedSubjects = $this->gradeService->passedSubjects($percentArray);
        $passedCount= count($passedSubjects);
        $data['schoolid'] = $school['id'];
        $data['totalmarks'] = array_sum($totalsArray);
        $data['percentage'] = $this->gradeService->getPercentage($data['totalmarks'],550);
        $data['grade'] = $this->gradeService->gradecalculation($data['totalmarks']);
        $studentrecord = Hsconehumanities::create($data);
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
            $items['civicsmarks'] +
            $items['sociologymarks'] + $items['educationsmarks'] +
            $items['islamichistorymarks'] + $items['islamicstudiesmarks'] + $items['economicsmarks'] +
            $items['generalhistorymarks'];
            $percentage = ($totalmarks*550)/100;
            $grade = $this->gradeService->gradecalculation($percentage);
            $items->totalmarks = $totalmarks;
            $items->percentage = $percentage;
            $items->schoolid = $schoolid['id'];
            $items->created_at = $now;
            $items->updated_at = $now;
             $formattedarray[]= $items;
        }
        Hsconehumanities::insert($formattedarray);
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
