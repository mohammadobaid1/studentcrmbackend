<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hsconehumanities;
use App\Services\GradeService;
use App\School;
use Carbon\Carbon;
use App\Student;
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
        $data = Hsconehumanities::with('studentinfo.schoolname')->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function humanitiesCalc($request, $data){
        if (isset($request['schoolid'])){
            $schoolid = $request["schoolid"];
        }else if (isset($request['schoolname'])) {
            $school = School::firstorCreate(['schoolname'=> $request["schoolname"]]);
            $schoolid = $school['id'];
        }
        $firstyearexamuniquekey = $request['enrollmentnumber'].$request['yearappearing'];
        $studentid = Student::firstorCreate(['firstyearexamuniquekey'=> $firstyearexamuniquekey],['studentname'=> $request['studentname'],'fathername'=> $request['fathername'],'schoolid'=> $schoolid,'enrollmentnumber'=> $request['enrollmentnumber'],'dateofbirth' => $request['dateofbirth'],'firstyearexamuniquekey'=> $firstyearexamuniquekey]);
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
        $data = $this->humanitiesCalc($request,$data);
        $studentrecord = Hsconehumanities::create($data);
        return $studentrecord;
    }
    public function bulkrecordinsert(Request $request)
    {
        $response = $request->json()->all();
        $formattedarray = [];
        foreach( $response as $data){
            $now = Carbon::now('utc')->toDateTimeString();
            $data = $this->humanitiesCalc($data,$data);
            $data['created_at'] = $now;
            $data['updated_at'] = $now;

            $formattedarray[]=[
                'englishmarks' => $data['englishmarks'] ?? 'A',
                'urdumarks' => $data['urdumarks'] ?? 'A',
                'islamiatmarks' => $data['islamiatmarks'] ?? 'A',
                'civicsmarks' => $data['civicsmarks']?? 'A',
                'sociologymarks' => $data['sociologymarks']?? 'A',
                'educationsmarks' => $data['educationsmarks']?? 'A',
                'islamichistorymarks' => $data['islamichistorymarks']?? 'A',
                'economicsmarks' => $data['economicsmarks'] ?? 'A',
                'islamicstudiesmarks' => $data['islamicstudiesmarks'] ?? 'A',
                'generalhistorymarks' => $data['generalhistorymarks'] ?? 'A',
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
    public function update(Request $request)
    {
        $data = $request->all();
        $user =  Student::find($request['studentinfo']['id']);
        $user->studentname = $request['studentinfo']['studentname'];
        $user->fathername = $request['studentinfo']['fathername'];
        $user->save();

        $mandatorySubjectsTotal =$this->gradeService->totalOfMandatorySubjects($data);
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
        $data['totalmarks'] = array_sum($totalsArray);
        $data['percentage'] = $this->gradeService->getPercentage($data['totalmarks'],550);
        $data['grade'] = $this->gradeService->gradecalculation($data['totalmarks']);
        $data['totalclearedpaper'] = $passedCount;

        unset($data['studentinfo']);
        Hsconehumanities::where('id', $data['id'])->update($data);

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
        $examData = Hsconehumanities::find($request['id']);
        $user = Student::find($request['studentinfo']['id']);
        $examData->delete();
        $user->delete();
        return response()->json([
            'success'   =>  true,
            'data' => $examData
        ], 200);
    }
}
