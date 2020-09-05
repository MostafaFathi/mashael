<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = ['parent_id', 'type', 'user_id','value'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
