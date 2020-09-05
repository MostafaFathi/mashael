<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::paginate(10);
        return view('admin.course.index', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:courses|max:255',
            'category_id' => 'required|exists:categories',
            'type_id' => 'required|exists:types',
        ]);

        $course = new Course();
        $course->name = $request->name;
        $course->type_id = $request->type_id;
        $course->trainer_id = $request->trainer_id;
        $course->description = $request->description;
        $course->price = $request->price ? $request->price : 0;
        $course->price2 = $request->price2 ? $request->price2 : 0;
        $course->date_time = $request->date_time ;
        $course->coordinates = $request->coordinates ;
        $course->address = $request->address ;
        $course->slider = $request->slider ;
        $course->persons = $request->persons ;
        $course->register_status = $request->register_status === null  ? 1 : 0 ;
        $course->intro = $request->intro;
        $course->intro_image = $request->intro_image;

        if($request->file('image')){
            $course->image = $request->file('image')->store('courses');
        }

        if($request->file('sliderImage')){
            $course->sliderImage = $request->file('sliderImage')->store('courses');
        }
        $course->save();

        $course->reCategory($request->category_id);

        return redirect()->route('admin::course.index')->with("success", "created");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('admin.course.edit', ['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:courses,'.$course->id,
            'category_id' => 'required|exists:categories',
            'type_id' => 'required|exists:types',

        ]);

        $course->name = $request->name;
        $course->type_id = $request->type_id;
        $course->trainer_id = $request->trainer_id;
        $course->description = $request->description;
        $course->price = $request->price ? $request->price : 0;
        $course->price2 = $request->price2 ? $request->price2 : 0;
        $course->date_time = $request->date_time;
        $course->coordinates = $request->coordinates ;
        $course->address = $request->address ;
        $course->slider = $request->slider ;
        $course->persons = $request->persons ;
        $course->register_status = $request->register_status === null  ? 1 : 0 ;
        $course->intro = $request->intro;
        $course->intro_image = $request->intro_image;

        if($request->file('image')){
            $course->image = $request->file('image')->store('courses');
        }

        if($request->file('sliderImage')){
            $course->sliderImage = $request->file('sliderImage')->store('courses');
        }
        $course->save();

        $course->reCategory($request->category_id);

        return redirect()->route('admin::course.index')->with("success", "updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin::course.index')->with("success", "Deleted");
    }
}
