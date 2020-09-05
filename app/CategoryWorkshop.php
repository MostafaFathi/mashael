<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryWorkshop extends Model
{
    protected $table = 'category_workshop';
    protected $fillable = ['workshop_id','category_id'];
    public $timestamps = false;
}
