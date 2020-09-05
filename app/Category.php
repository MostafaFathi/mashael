<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'image'];

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'category_course');
    }
}
