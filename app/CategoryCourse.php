<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryCourse extends Model
{
    protected $table = 'category_course';
    protected $fillable = ['course_id','category_id'];
    public $timestamps = false;
}
