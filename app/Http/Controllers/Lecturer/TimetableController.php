<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Timetable;
use App\studentTimetable;
use Carbon;
class TimetableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myTimetable($id)
    {
        $timetables = Timetable::where('lecturer_id',$id)->get();

        // dd($timetables);

        return view('lecturer.index')->with([
            'timetables' => $timetables
        ]);
    }

    public function classDetails($id)
    {
        $timetable = Timetable::where('id',$id)->first();

        $attendance = $timetable->classReg()->get();
        // dd($attendance);

        $mydate = date("Y-m-d");

        return view('lecturer.attend')->with([
            'mydate' => $mydate,
            'timetable' => $timetable,
            'attendance' => $attendance
        ]);

    }

    public function attendance(Request $request, $id)
    {
        $timetable = Timetable::where('id',$id)->first();
        $input = $request->get('attend');
        // dd($input);
        foreach($input as $key=>$value){
            studentTimetable::where('id',$key)->update(['attendance'=>$value]); 
        }
        return redirect()->route('lecturer.myTimetable',$timetable->lecturer_id);
        
    }

}
