<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subjects extends Model
{
    use SoftDeletes;
    
    protected $table = 'subjects';
    protected $fillable = [
        'name','description','price',
    ];

    public function users(){
        return $this->belongsToMany('App\User')->using('App\lecturer_subjects');
    }

    public function timetable(){
        return $this->hasOne('App\Timetable','subject_id');
    }

} 
