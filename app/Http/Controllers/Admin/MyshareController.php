<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Myshare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MyshareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myshares = Myshare::paginate(10);
        return  view('admin.myshare.index',['myshares' => $myshares]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.myshare.create');
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
            'name' => 'required|unique:myshares|max:255',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        $myshare = new Myshare();
        $myshare->name = $request->name;
        $myshare->slug = Str::slug($request->name);
        $myshare->type = $request->type;
        $myshare->description = $request->description;
        if($request->file('image')){
            $myshare->image = $request->file('image')->store('myshares');
        }

        $myshare->url = $request->url;
        $myshare->save();

        return redirect()->route('admin::myshare.index')->with("success","created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Myshare  $myshare
     * @return \Illuminate\Http\Response
     */
    public function show(Myshare $myshare)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Myshare  $myshare
     * @return \Illuminate\Http\Response
     */
    public function edit(Myshare $myshare)
    {
        return  view('admin.myshare.edit',['myshare' => $myshare]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Myshare  $myshare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Myshare $myshare)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:myshares|max:255',
            'image' => 'required|image',
            'description' => 'required',
        ]);

        $myshare->name = $request->name;
        $myshare->slug = Str::slug($request->slug);
        $myshare->type = $request->type;
        $myshare->description = $request->description;
        if($request->file('image')){
            $myshare->image = $request->file('image')->store('myshares');
        }

        $myshare->url = $request->url;
        $myshare->save();

        return redirect()->route('admin::myshare.index')->with("success","updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Myshare  $myshare
     * @return \Illuminate\Http\Response
     */
    public function destroy(Myshare $myshare)
    {
        $myshare->delete();
        return redirect()->route('admin::myshare.index')->with("success","Deleted");
    }
}
