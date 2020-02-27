<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hsconepremed;
use App\Services\GradeService;
use App\School;
use Carbon\Carbon;
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
        return Hsconepremed::all();
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

        $studentrecord = Hsconepremed::create($data);

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
            $items['chemistrypracticalmarks'] + $items['zoologymarks'] + $items['botanymarks'];
            $percentage = ($totalmarks*500)/100;
            $items->totalmarks = $totalmarks;
            $items->percentage = $percentage;
            $items->schoolid = $schoolid['id'];
            $items->created_at = $now;
            $items->updated_at = $now;
             $formattedarray[]= $items;
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
