<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials =  Testimonial::paginate(10);
        return  view('admin.testimonial.index',['testimonials' => $testimonials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.testimonial.create');
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
            'name' => 'required|unique:testimonials|max:255',
            'description' => 'required',
            'image' => 'required|image',
            'category_id' => 'required',
        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
//        $testimonial->birthday = $request->birthday;
        $testimonial->description = $request->description;
        if($request->file('image')){
            $testimonial->image = $request->file('image')->store('testimonials');
        }
        $testimonial->save();

        return redirect()->route('admin::testimonial.index')->with("success","created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return  view('admin.testimonial.edit',['testimonial' => $testimonial]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:testimonials|max:255',
            'image' => 'required|image',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        $testimonial->name = $request->name;
//        $testimonial->birthday = $request->birthday;
        $testimonial->description = $request->description;
        if($request->file('image')){
            $testimonial->image = $request->file('image')->store('testimonials');
        }
        $testimonial->save();

        return redirect()->route('admin::testimonial.index')->with("success","updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin::testimonial.index')->with("success","Deleted");
    }
}
