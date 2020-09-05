<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types =  Type::paginate(10);
        return  view('admin.type.index',['types' => $types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.type.create');
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
            'name' => 'required|unique:types|max:255',
            'description' => 'required',
            'image' => 'required|image',
            'category_id' => 'required',
        ]);

        $type = new Type();
        $type->name = $request->name;
        $type->description = $request->description;
        if($request->file('image')){
            $type->image = $request->file('image')->store('types');
        }
        $type->save();

        return redirect()->route('admin::type.index')->with("success","created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return  view('admin.type.edit',['type' => $type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:types|max:255',
            'image' => 'required|image',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        $type->name = $request->name;
        $type->description = $request->description;
        if($request->file('image')){
            $type->image = $request->file('image')->store('types');
        }
        $type->save();

        return redirect()->route('admin::type.index')->with("success","updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin::type.index')->with("success","Deleted");
    }
}
