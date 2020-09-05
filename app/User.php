<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'firstname', 'lastname','mobile', 'notes', 'ip', 'status','country','city','address','birthday','post_code'
    ];


    function getNameAttribute()
    {
        return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function avatar()
    {
        return url('themes/administrator') . "/img/avatars/1.jpg";
    }

    function courses()
    {
        return $this->belongsToMany("App\Course", 'orders');
    }

    function workshops()
    {
        return $this->belongsToMany("App\Workshop", 'orders');
    }

    function orders()
    {
        return $this->hasMany("App\Order");
    }

    function questions()
    {
        return $this->hasMany("App\Question");
    }
}
