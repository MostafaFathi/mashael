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
        'email', 'password', 'firstname', 'lastname', 'gender', 'age', 'mobile', 'notes', 'ip', 'status', 'country', 'city', 'address', 'birthday', 'post_code'
    ];

    protected $appends = ['gender_name'];
    function getNameAttribute()
    {
        return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }
    function getGenderNameAttribute()
    {
        if ($this->gender == 'm') {
            return 'ذكر';
        } else if ($this->gender == 'f') {
            return 'أنثى';
        } else {
            return '--';
        }

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

    public function orders()
    {
        return $this->hasMany("App\Order");
    }

    function questions()
    {
        return $this->hasMany("App\Question");
    }
}
