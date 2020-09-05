<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['session_id','course_id', 'user_id', 'description', 'price', 'status','workshop_id'];


    public function course()
    {
        return $this->belongsTo('App\Course');
    }


    public function workshop()
    {
        return $this->belongsTo('App\Workshop');
    }


    public function session()
    {
        return $this->belongsTo('App\Session');
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
