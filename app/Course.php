<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'description', 'file', 'image', 'year', 'key_id'];

    protected $dates = ['date_time','created_at', 'updated_at', 'deleted_at'];

    public function reCategory($array = [])
    {
        $exits = [];
        $notExists = [];
        if (is_array($array)) {
            foreach ($array as $id) {
                $data = [
                    'course_id' => $this->id,
                    'category_id' => $id,
                ];

                $key = CategoryCourse::where($data)->first();
                if ($key) {
                    $exits[] = $data;
                } else {
                    $notExists[] = $data;
                }
            }

        } else {
            $data = [
                'course_id' => $this->id,
                'category_id' => $array,
            ];

            $key = CategoryCourse::where($data)->first();
            if ($key) {
                $exits[] = $data;
            } else {
                $notExists[] = $data;
            }

            $array = [$array];
        }

        CategoryCourse::insert($notExists);
        CategoryCourse::where('course_id', $this->id)->whereNotIn('category_id', $array)->delete();
        return true;
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_course');
    }

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

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
        return $this->hasMany("App\Rate",'parent_id')->where('type','course');
    }
}
