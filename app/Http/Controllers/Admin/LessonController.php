<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::paginate(10);
        return view('admin.lesson.index', ['lessons' => $lessons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lesson.create');
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

            'name' => 'required|unique:lessons|max:255',
            'video_url' => 'video_url',
            'course_id' => 'required|exists:courses',

        ]);

        $lesson = new Lesson();
        $lesson->name = $request->name;
        if($request->file('video_file')){
            $lesson->video_url = Storage::url($request->file('video_file')->store('lessons'));
        }else{
            $lesson->video_url = $request->video_url;
        }
        $lesson->course_id = $request->course_id;
        $lesson->type_id = $request->type_id;
        $lesson->description = $request->description;
        $lesson->time = $request->time;
        if ($request->file('image')) {
            $lesson->image = $request->file('image')->store('lessons');
        }
        $lesson->save();

        return redirect()->route('admin::lesson.index')->with("success", "created");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        return view('admin.lesson.edit', ['lesson' => $lesson]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:lessons,'.$lesson->id,
            'course_id' => 'required|exists:courses',
        ]);

        $lesson->name = $request->name;
        if($request->file('video_file')){
            $lesson->video_url = url('/').Storage::url($request->file('video_file')->store('lessons'));
        }else{
            $lesson->video_url = $request->video_url;
        }
        $lesson->course_id = $request->course_id;
        $lesson->type_id = $request->type_id;
        $lesson->description = $request->description;
        $lesson->time = $request->time;
        if ($request->file('image')) {
            $lesson->image = $request->file('image')->store('lessons');
        }
        $lesson->save();

        return redirect()->route('admin::lesson.index')->with("success", "updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('admin::lesson.index')->with("success", "Deleted");
    }

}
