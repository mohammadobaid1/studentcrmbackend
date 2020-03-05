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
        $data = Hsconegeneralscience::with('studentinfo.schoolname')->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gsCalc($request, $data){
        if (isset($request['schoolid'])){
            $schoolid = $request["schoolid"];
        }else if (isset($request['schoolname'])) {
            $school = School::firstorCreate(['schoolname'=> $request["schoolname"]]);
            $schoolid = $school['id'];
        }
        $firstyearexamuniquekey = $request['enrollmentnumber'].$request['yearappearing'];
        $studentid = Student::firstorCreate(['firstyearexamuniquekey'=> $firstyearexamuniquekey],['studentname'=> $request['studentname'],'fathername'=> $request['fathername'],'schoolid'=> $schoolid,'enrollmentnumber'=> $request['enrollmentnumber'],'dateofbirth' => $request['dateofbirth'],'firstyearexamuniquekey'=> $firstyearexamuniquekey]);
        $mandatorySubjectsTotal =$this->gradeService->totalOfMandatorySubjects($data);
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
        $data['totalmarks'] = array_sum($totalsArray);
        $data['percentage'] = $this->gradeService->getPercentage($data['totalmarks'],550);
        $data['grade'] = $this->gradeService->gradecalculation($data['totalmarks']);
        $data['totalclearedpaper'] = $passedCount;
        $data['enrollmentnumber'] = $firstyearexamuniquekey;
        return $data;
    }
    public function create(Request $request)
    {
        $data = $request->except(['schoolname','studentname','fathername','enrollmentnumber']);
        $data = $this->gsCalc($request,$data);
        $studentrecord = Hsconegeneralscience::create($data);
        return $studentrecord;
    }
    public function bulkrecordinsert(Request $request)
    {
        $response = $request->json()->all();
        $formattedarray = [];
        foreach( $response as $data){
            $now = Carbon::now('utc')->toDateTimeString();
            $data = $this->gsCalc($data,$data);
            $data['created_at'] = $now;
            $data['updated_at'] = $now;

            $formattedarray[]=[
                'englishmarks' => $data['englishmarks'] ?? 'A',
                'urdumarks' => $data['urdumarks'] ?? 'A',
                'islamiatmarks' => $data['islamiatmarks'] ?? 'A',
                'computertheorymarks' => $data['computertheorymarks']?? 'A',
                'computerpracticalmarks' => $data['computerpracticalmarks']?? 'A',
                'mathmarks' => $data['mathmarks']?? 'A',
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
        $data = $request->all();
        $user =  Student::find($request['studentinfo']['id']);
        $user->studentname = $request['studentinfo']['studentname'];
        $user->fathername = $request['studentinfo']['fathername'];
        $user->save();

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
        $data['totalmarks'] = array_sum($totalsArray);
        $data['percentage'] = $this->gradeService->getPercentage($data['totalmarks'],550);
        $data['grade'] = $this->gradeService->gradecalculation($data['totalmarks']);
        $data['totalclearedpaper'] = $passedCount;

        unset($data['studentinfo']);
        Hsconegeneralscience::where('id', $data['id'])->update($data);

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
        $examData = Hsconegeneralscience::find($request['id']);
        $user = Student::find($request['studentinfo']['id']);
        $examData->delete();
        $user->delete();
        return response()->json([
            'success'   =>  true,
            'data' => $examData
        ], 200);
    }
}
