<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['name', 'description', 'file', 'image', 'year', 'key_id'];

    protected $dates = ['date_time_end','date_time','created_at', 'updated_at', 'deleted_at'];

    public function users()
    {
        return $this->belongsToMany("App\User", 'orders');
    }

    public function check()
    {
        return $this->hasOne("App\Order")->where('user_id', auth()->user()->id);
    }

    public function orders()
    {
        return $this->hasMany("App\Order");
    }

    public function trainer()
    {
        return $this->belongsTo("App\Trainer");
    }

    public function type()
    {
        return $this->belongsTo("App\Type");
    }

    public function rates()
    {
        return $this->hasMany("App\Rate",'parent_id')->where('type','session');
    }
}
