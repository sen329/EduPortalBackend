<?php

namespace App\Http\Controllers;

use App\StudentTimetable;
use Illuminate\Http\Request;
use Auth;
use App\User;

class StudentTimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $STimetable = StudentTimetable::all();

        return view('timetable.index')->with([
            'STimetable' => $STimetable
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('STimetable.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $STimetable = StudentTimetable::create([
            'student_id' => $request->get('student_id'),
            'subject_id' => $request->get('timetables_id'),
            
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentTimetable  $studentTimetable
     * @return \Illuminate\Http\Response
     */
    public function show(StudentTimetable $studentTimetable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentTimetable  $studentTimetable
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentTimetable $studentTimetable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentTimetable  $studentTimetable
     * @return \Illuminate\Http\Response
     */
    public function update_paid(Request $request, StudentTimetable $studentTimetable)
    {
        $input =  $request->all();
        $studentTimetable->fill($input)->save();
    }

    public function update_attendance(Request $request, StudentTimetable $studentTimetable)
    {
        $studentTimetable->attendance = request('attendance');

        $studentTimetable->save();
    }

    public function update_completion(Request $request, StudentTimetable $studentTimetable)
    {
        $studentTimetable->completion = request('completion');

        $studentTimetable->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentTimetable  $studentTimetable
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentTimetable $studentTimetable)
    {
        $studentTimetable->delete();
        return redirect()->route('studentTimetable.index');
    }

    public function upload_payment(){
        
    }

}
