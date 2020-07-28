<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\StudentReg;
use Illuminate\Http\Request;

class StudentregController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentRegs = StudentReg::all();
        return view('admin.studentreg.index')->with([
            'studentRegs' => $studentRegs
        ]);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentReg  $studentReg
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentReg $studentreg)
    {
        return view('admin.studentreg.edit')->with([
            'studentreg' => $studentreg
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentReg  $studentReg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentReg $studentreg)
    {
        $studentreg->paid = request('paid');

        $studentreg->save();

        return redirect()->route('admin.studentreg.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentReg  $studentReg
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentReg $studentReg)
    {
        $studentReg->delete();
        return redirect()->route('admin.studentreg.index');
    }
}
