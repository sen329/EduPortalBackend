<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timetable;
use App\StudentTimetable;
use App\Subjects;
use App\User;
use App\StudentReg;

class TimetableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $timetables = Timetable::all();

        return view('timetable.index')->with([
            'timetables' => $timetables
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subjects::all();
        $lecturers = User::role('Lecturer')->get();
        return view('timetable.create')->with([
            'subjects' => $subjects,
            'lecturers' => $lecturers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $timetable = Timetable::create([
            'subject_id' => $request->get('subject_id'),
            'lecturer_id' => $request->get('lecturer_id'),
            'online' =>$request->get('online'),
            'address'=>$request->get('address'),
            'date'=> $request->get('date'),
            'time' => $request->get('time')
        ]);
        
        $studentReg = StudentReg::where('subject_id',$request->get('subject_id'))->get();

        // dd($studentReg);
        foreach($studentReg as $tes){
            if($tes->paid == 1 && $tes->complete== 0){
                $timetable->classReg()->attach($tes->id);
            }
        }

        return redirect()->route('timetable.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Timetable $timetable)
    {
        $lecturers = User::role('Lecturer')->get();
        return view('timetable.edit')->with([
            'timetable' => $timetable,
            'lecturers' => $lecturers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timetable $timetable)
    {
        $timetable->lecturer_id = request('lecturer_id');
        $timetable->online = request('online');
        $timetable->address = request('address');
        $timetable->date = request('date');
        $timetable->time = request('time');

        $timetable->save();

        return redirect()->route('timetable.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timetable $timetable)
    {
        $timetable->delete();
        return redirect()->route('timetable.index');
    }

    public function getLecturer($id) 
{        
    if($id!=0){
        $lecturers = User::find($id)->subject()->select('id', 'name')->get()->toArray();
    }else{
        $lecturers = User::$users = User::role('Lecturer')->toArray();
    }
    return response()->json($lecturers);   
}
}
