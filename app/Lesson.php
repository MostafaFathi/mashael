<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['name', 'description', 'file', 'image', 'year', 'key_id'];



    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function type()
    {
        return $this->belongsTo('App\Type');
    }

}
