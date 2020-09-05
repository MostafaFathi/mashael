<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::paginate(10);
        return view('admin.answer.index', ['answers' => $answers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.answer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'answer' => 'required',
            'question_id' => 'required',
        ]);


        $answer = new Answer();
        $answer->answer = $request->answer;
        $answer->question_id = $request->question_id;
        $answer->save();

        return redirect()->route('admin::question.edit',$request->question_id)->with("success", "created");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        return view('admin.answer.edit', ['answer' => $answer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:answers,'.$answer->id,
            'category_id' => 'required|exists:categories',
            'type_id' => 'required|exists:types',

        ]);

        $answer->name = $request->name;
        $answer->type_id = $request->type_id;
        $answer->trainer_id = $request->trainer_id;
        $answer->description = $request->description;
        $answer->price = $request->price ? $request->price : 0;
        $answer->date_time = $request->date_time;
        $answer->coordinates = $request->coordinates ;
        $answer->address = $request->address ;
        $answer->slider = $request->slider ;

        if($request->file('image')){
            $answer->image = $request->file('image')->store('answers');
        }

        if($request->file('sliderImage')){
            $answer->sliderImage = $request->file('sliderImage')->store('answers');
        }
        $answer->save();

        $answer->reCategory($request->category_id);

        return redirect()->route('admin::answer.index')->with("success", "updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();
        return redirect()->route('admin::answer.index')->with("success", "Deleted");
    }
}
