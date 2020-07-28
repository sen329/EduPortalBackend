<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::user() != null) {
        if(Auth::user()->hasRole('Admin')){
            return redirect()->route('admin.index');
        }else if(Auth::user()->hasRole('Staff')){
            return view('staff.index');
        } else if(Auth::user()->hasRole('Lecturer')){
            return redirect()->route('lecturer.myTimetable',Auth::user()->id);
        } 
    } else {
        return view('auth.login');
    }
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['role:Staff']], function(){
    Route::namespace('Staff')->prefix('staff')->name('staff.')->group(function(){
        Route::resource('/','StaffController',['only' => ['index']]);
        Route::resource('/lecturer', 'LecturerController', ['except' => ['show']]);
        Route::resource('/studentreg','StudentregController',['except' => ['show', 'create', 'store']]);
    });
    Route::resource('/staff/timetable','TimetableController',['except'=>['show']]);
    Route::resource('staff/subject','SubjectController',['except'=>['show']]);
    Route::get('staff/timetable/getlecturer/{id}','TimetableController@getLecturer');
});

Route::group(['middleware' => ['role:Admin']], function(){
    Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
        Route::resource('/','AdminController',['only' => ['index']]);
        Route::resource('/staff','StaffController',['except' => ['show']]);
        Route::resource('/lecturer','LecturerController', ['except' => ['show']]);
        Route::resource('/subject','SubjectController',['except'=>['show']]);
        Route::resource('/studentreg','StudentregController',['except' => ['show', 'create', 'store']]);
        Route::get('/classes','ClassesController@timetable')->name('classes');
        Route::get('/classDetails/{id}','ClassesController@classDetails')->name('classDetails');
        Route::put('/attendance/{id}','ClassesController@attendance')->name('attendance');
        Route::resource('/timetable','TimetableController',['except'=>['show']]);
        Route::resource('/student','StudentController',['except' =>['show']]);
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['role:Lecturer']], function(){
    Route::namespace('Lecturer')->prefix('lecturer')->name('lecturer.')->group(function(){
        Route::get('/{id}','TimetableController@myTimetable')->name('myTimetable');
        Route::get('/classDetails/{id}','TimetableController@classDetails')->name('classDetails');
        Route::put('/attendance/{id}','TimetableController@attendance')->name('attendance');
    });
    
});
