<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timetable extends Model
{
    use SoftDeletes;
    
    protected $table = 'timetables';
    protected $fillable = [
        'subject_id','lecturer_id','online','address','date','time'
    ];

    public function subject(){
        return $this->belongsTo('App\Subjects');
    }

    public function lecturer(){
        return $this->belongsTo('App\User');
    }

    public function classReg(){
        return $this->belongsToMany('App\StudentReg','student_timetables','timetable_id','reg_id');
    }

}
