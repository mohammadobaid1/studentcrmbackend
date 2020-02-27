<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hsconecommerce;
use App\Services\GradeService;
use App\School;
use Carbon\Carbon;
class HsconecommerceController extends Controller
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
        return Hsconecommerce::all();
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
        $accountingTotal = $data['accountingmarks'];
        $commerceTotal = $data['commercemarks'];
        $economicsTotal=  $data['economicsmarks'];
        $mathTotal=  $data['mathmarks'];
        $engPercent = $this->gradeService->getPercentage($data['englishmarks'],100);
        $urduPercent = $this->gradeService->getPercentage($data['urdumarks'],100);
        $islPercent = $this->gradeService->getPercentage($data['islamiatmarks'],50);
        $accountingPercent = $this->gradeService->getPercentage($accountingTotal,100);
        $commercePercent = $this->gradeService->getPercentage($commerceTotal,75);
        $economicsPercent = $this->gradeService->getPercentage($economicsTotal,75);
        $mathPercent = $this->gradeService->getPercentage($mathTotal,50);

        $passedSubjects = $this->gradeService->passedSubjects([$engPercent,$urduPercent,$islPercent,$accountingPercent,$commercePercent,$economicsPercent,$mathPercent]);
        $passedCount= count($passedSubjects);
        $data['schoolid'] = $school['id'];
        $data['totalmarks'] = $mandatorySubjectsTotal + $accountingTotal + $commerceTotal + $economicsTotal + $mathTotal;
        $data['percentage'] = $this->gradeService->getPercentage($data['totalmarks'],550);
        $data['grade'] = $this->gradeService->gradecalculation($data['totalmarks']);

        $studentrecord = Hsconecommerce::create($data);
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
            $items['accountingmarks'] +
            $items['commercemarks'] + $items['economicsmarks'] +
            $items['mathmarks'];
            $percentage = ($totalmarks*400)/100;
            $grade = $this->gradeService->gradecalculation($percentage);
            $items->totalmarks = $totalmarks;
            $items->percentage = $percentage;
            $items->schoolid = $schoolid['id'];
            $items->created_at = $now;
            $items->updated_at = $now;
             $formattedarray[]= $items;
        }
        Hsconecommerce::insert($formattedarray);
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
