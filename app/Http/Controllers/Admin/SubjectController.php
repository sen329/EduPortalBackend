<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subjects;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $subjects = Subjects::all();

        return view('admin.subjects.index')->with([
            'subjects'=>$subjects
            ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = Subjects::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price')
            
        ]);

        return redirect()->route('admin.subject.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function edit(Subjects $subject)
    {
        return view('admin.subjects.edit')->with([
            'subject' => $subject,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subjects $subject)
    {
        $subject->description = request('description');
        $subject->price = request('price');
        $subject->save();

        return redirect()->route('admin.subject.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subjects $subject)
    {
        $subject->delete();

        return redirect()->route('admin.subject.index');
    }
}
