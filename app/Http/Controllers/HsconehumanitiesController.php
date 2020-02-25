<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hsconehumanities;
use App\Services\GradeService;
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
        $studentrecord = Hsconehumanities::create($request->all());
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
            $percentage = ($totalmarks*700)/100;
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
