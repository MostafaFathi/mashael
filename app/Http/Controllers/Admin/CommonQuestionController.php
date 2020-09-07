<?php

namespace App\Http\Controllers\Admin;

use App\CommonQuestion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommonQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = CommonQuestion::paginate(10);
        return view('admin.common_question.index', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.common_question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:common_questions|max:255',
        ]);

        $question = new CommonQuestion();
        $question->name = $request->name;
        $question->description = $request->description;
        $question->answer = $request->answer;
        $question->save();


        return redirect()->route('admin::common.index')->with("success", "created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commonQuestion = CommonQuestion::find($id);
        return view('admin.common_question.edit', ['question' => $commonQuestion]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:common_questions,'.$id,

        ]);
        $commonQuestion = CommonQuestion::find($id);
        $commonQuestion->name = $request->name;
        $commonQuestion->description = $request->description;
        $commonQuestion->answer = $request->answer;

        $commonQuestion->save();


        return redirect()->route('admin::common.index')->with("success", "updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commonQuestion = CommonQuestion::find($id);
        $commonQuestion->delete();
        return redirect()->route('admin::common.index')->with("success", "Deleted");
    }
}
