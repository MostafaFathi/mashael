<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    function answers()
    {
        return $this->hasMany("App\Answer");
    }

    function user()
    {
        return $this->belongsTo("App\User");
    }
}
