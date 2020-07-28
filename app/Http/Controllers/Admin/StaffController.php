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

class StaffController extends Controller
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
        $staffs = User::role('Staff')->get();

        return view('admin.staff.index')->with([
            'staffs' =>$staffs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staff.create');
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
            'password' => 'required|min:6|confirmed',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:16384',
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
    
                $user->assignRole('Staff');
                if($request->avatar !=null){
                    $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

                $request->avatar->storeAs('/avatars',$avatarName);

                $user->avatar = $avatarName;
                
                $user->save();
                }
                DB::commit();

                return redirect()->route('admin.staff.index')->with("Sucesss");
            }
            catch(Exception $e){
                DB::rollback();
                dd($e);
                return redirect()->back()->withError('Create user failed', $e);
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $staff)
    {
        return view('admin.staff.edit')->with([
            'user' => $staff,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $staff)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:16384',
        ]);
        $staff->name = request('name');
        $staff->email = request('email');
        $staff->address = request('address');
        $staff->phone_number = request('phone_number');
        // $user->password =Hash::make(request('password'));
        
        $update = array_filter($request->except('password'));

        // dd($update);
        if (trim(request('password')) != '') {
            $staff->password = Hash::make(trim(request('password')));
         }

         if($request->avatar !=null){
            $avatarName = $staff->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('/avatars',$avatarName);

        $staff->avatar = $avatarName;
        
        }
        $staff->update($update);

        return redirect()->route('admin.staff.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $staff)
    {
        $staff->delete();

        return redirect()->route('admin.staff.index');
    }

}
