<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::paginate(10);
        return view('admin.question.index', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.question.create');
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
            'name' => 'required|unique:questions|max:255',
            'category_id' => 'required|exists:categories',
            'type_id' => 'required|exists:types',
        ]);

        $question = new Question();
        $question->name = $request->name;
        $question->type_id = $request->type_id;
        $question->trainer_id = $request->trainer_id;
        $question->description = $request->description;
        $question->price = $request->price ? $request->price : 0;
        $question->date_time = $request->date_time ;
        $question->coordinates = $request->coordinates ;
        $question->address = $request->address ;
        $question->slider = $request->slider ;

        if($request->file('image')){
            $question->image = $request->file('image')->store('questions');
        }

        if($request->file('sliderImage')){
            $question->sliderImage = $request->file('sliderImage')->store('questions');
        }
        $question->save();

        $question->reCategory($request->category_id);

        return redirect()->route('admin::question.index')->with("success", "created");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('admin.question.edit', ['question' => $question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:questions,'.$question->id,
            'category_id' => 'required|exists:categories',
            'type_id' => 'required|exists:types',

        ]);

        $question->name = $request->name;
        $question->type_id = $request->type_id;
        $question->trainer_id = $request->trainer_id;
        $question->description = $request->description;
        $question->price = $request->price ? $request->price : 0;
        $question->date_time = $request->date_time;
        $question->coordinates = $request->coordinates ;
        $question->address = $request->address ;
        $question->slider = $request->slider ;

        if($request->file('image')){
            $question->image = $request->file('image')->store('questions');
        }

        if($request->file('sliderImage')){
            $question->sliderImage = $request->file('sliderImage')->store('questions');
        }
        $question->save();

        $question->reCategory($request->category_id);

        return redirect()->route('admin::question.index')->with("success", "updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin::question.index')->with("success", "Deleted");
    }
}
