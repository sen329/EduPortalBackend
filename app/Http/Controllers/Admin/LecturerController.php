<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Auth;
use DB;
use Exception;
use App\Subjects;

class LecturerController extends Controller
{
    use RegistersUsers;

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
        $users = User::role('Lecturer')->get();
        return view('admin.lecturers.index')->with([
            'users'=>$users
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
        
        return view('admin.lecturers.create')->with([
            'subjects' =>$subjects,
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'subject_id'=> 'required',
            'password' => 'required|min:6|confirmed',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:16384'
        ]);
        // dd($request->all());
            try{
                DB::beginTransaction();

                $user = User::create([
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'address' => $request->get('address'),
                    'phone_number' =>$request->get('phone_number'),
                    'password' => Hash::make($request->get('password')),
                ]);

                $user->assignRole('Lecturer');

                $user->subject()->attach(request('subject_id'));

                if($request->avatar !=null){
                    $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

                $request->avatar->storeAs('/avatars',$avatarName);

                $user->avatar = $avatarName;
                
                $user->save();
                }
                
                DB::commit();

                return redirect()->route('admin.lecturer.index')->with("Sucesss");
            }
            catch(Exception $e){
                DB::rollback();
                // dd($e);
                return redirect()->back()->withError('Create user failed', $e);
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $lecturer)
    {
        $subjects = Subjects::all();

        return view('admin.lecturers.edit')->with([
            'user'=>$lecturer,
            'subjects'=>$subjects,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $lecturer)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:16384',
        ]);
        $lecturer->name = request('name');
        $lecturer->email = request('email');
        $lecturer->address = request('address');
        $lecturer->phone_number = request('phone_number');
        // $user->password =Hash::make(request('password'));
        
        $update = array_filter($request->except('password'));

        // dd($update);
        if (trim(request('password')) != '') {
            $lecturer->password = Hash::make(trim(request('password')));
         }

         if($request->avatar !=null){
            $avatarName = $lecturer->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('/avatars',$avatarName);

        $lecturer->avatar = $avatarName;
        }
        
        if($request->get('subject_id') != null){
            $check = DB::table('lecturer_subjects')
            ->where([
                ['user_id',$lecturer->id],
                ['subject_id',request('subject_id')],
                ])
            ->whereNull('deleted_at')
            ->count()>0;

            if(!$check){
                $lecturer->subject()->detach();
                $lecturer->subject()->attach(request('subject_id'));
                $lecturer->update($update);
 
                return redirect()->route('admin.lecturer.index');
            }
            else{
                return redirect()->back()->withError('Subject already assigned to lecturer');
            }


        }
        
        $lecturer->update($update);
        return redirect()->route('admin.lecturer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $lecturer)
    {
        $lecturer->delete();

        return redirect()->route('admin.lecturer.index');
    }
}
