<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workshops = Workshop::paginate(10);
        return view('admin.workshop.index', ['workshops' => $workshops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.workshop.create');
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
            'name' => 'required|unique:workshops|max:255',
            'category_id' => 'required|exists:categories',
            'type_id' => 'required|exists:types',
        ]);

        $workshop = new Workshop();
        $workshop->name = $request->name;
        $workshop->type_id = $request->type_id;
        $workshop->trainer_id = $request->trainer_id;
        $workshop->description = $request->description;
        $workshop->price = $request->price ? $request->price : 0;
        $workshop->price2 = $request->price2 ? $request->price2 : 0;
        $workshop->date_time = $request->date_time ;
        $workshop->date_time_to = $request->date_time_to ;
        $workshop->coordinates = $request->coordinates ;
        $workshop->address = $request->address ;
        $workshop->slider = $request->slider ;
        $workshop->persons = $request->persons ;
        $workshop->intro = $request->intro ;
        $workshop->intro_image = $request->intro_image ;
        $workshop->register_status = $request->register_status === null  ? 1 : 0   ;

        if($request->file('image')){
            $workshop->image = $request->file('image')->store('workshops');
        }

        if($request->file('sliderImage')){
            $workshop->sliderImage = $request->file('sliderImage')->store('workshops');
        }
        $workshop->save();

        $workshop->reCategory($request->category_id);

        return redirect()->route('admin::workshop.index')->with("success", "created");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Workshop $workshop
     * @return \Illuminate\Http\Response
     */
    public function show(Workshop $workshop)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Workshop $workshop
     * @return \Illuminate\Http\Response
     */
    public function edit(Workshop $workshop)
    {
        return view('admin.workshop.edit', ['workshop' => $workshop]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Workshop $workshop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workshop $workshop)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:workshops,'.$workshop->id,
            'category_id' => 'required|exists:categories',
            'type_id' => 'required|exists:types',

        ]);

        $workshop->name = $request->name;
        $workshop->type_id = $request->type_id;
        $workshop->trainer_id = $request->trainer_id;
        $workshop->description = $request->description;
        $workshop->price = $request->price ? $request->price : 0;
        $workshop->price2 = $request->price2 ? $request->price2 : 0;
        $workshop->date_time = $request->date_time;
        $workshop->date_time_to = $request->date_time_to;
        $workshop->coordinates = $request->coordinates ;
        $workshop->address = $request->address ;
        $workshop->slider = $request->slider ;
        $workshop->persons = $request->persons ;
        $workshop->intro = $request->intro ;
        $workshop->intro_image = $request->intro_image ;
        $workshop->register_status = $request->register_status === null  ? 1 : 0  ;

        if($request->file('image')){
            $workshop->image = $request->file('image')->store('workshops');
        }

        if($request->file('sliderImage')){
            $workshop->sliderImage = $request->file('sliderImage')->store('workshops');
        }
        $workshop->save();

        $workshop->reCategory($request->category_id);

        return redirect()->route('admin::workshop.index')->with("success", "updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Workshop $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop)
    {
        $workshop->delete();
        return redirect()->route('admin::workshop.index')->with("success", "Deleted");
    }
}
