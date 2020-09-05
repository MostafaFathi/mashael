<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    protected $table = 'user_course';
    protected $fillable = ['course_id','user_id'];
    public $timestamps = false;
}
