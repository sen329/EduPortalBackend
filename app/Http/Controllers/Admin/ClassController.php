<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function timetable()
    {
        $timetables = Timetable::all();

        // dd($timetables);

        return view('admin.classes.index')->with([
            'timetables' => $timetables
        ]);
    }

    public function classDetails($id)
    {
        $timetable = Timetable::where('id',$id)->first();

        $attendance = $timetable->classReg()->get();
        // dd($attendance);

        return view('admin.classes.attend')->with([
            'timetable' => $timetable,
            'attendance' => $attendance
        ]);

    }

    public function attendance(Request $request, $id)
    {
        $input = $request->get('attend');
        // dd($input);
        foreach($input as $key=>$value){
            studentTimetable::where('id',$key)->update(['attendance'=>$value]); 
        }
        return redirect()->route('admin.timetable.index');
        
    }
}
