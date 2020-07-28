<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentReg extends Model
{
    use SoftDeletes;
    protected $table = 'student_regs';
    protected $fillable = [
        'student_id','subject_id','paid',
    ];

    public function subject(){
        return $this->belongsTo('App\Subjects');
    }

    public function student(){
        return $this->belongsTo('App\User');
    }

    public function timetable(){
        return $this->belongsToMany('App\Timetable', 'student_timetables','reg_id','timetable_id');
    }
}
