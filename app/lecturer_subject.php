<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class lecturer_subject extends Model
{
    use SoftDeletes;
    protected $table = 'lecturer_subject';
    protected $fillable = [
        'user_id','subject_id',
    ];
   
}
