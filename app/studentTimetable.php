<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class studentTimetable extends Model
{
    protected $table = 'student_timetables';
    protected $fillable = [
        'attendance',
    ];

    public function reg(){
        return $this->belongsTo('App\StudentReg');
    }

    public function timetable(){
        return $this->belongsTo('App\Timetable');
    }
}
