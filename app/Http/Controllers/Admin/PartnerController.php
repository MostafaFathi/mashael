<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners =  Partner::paginate(10);
        return  view('admin.partner.index',['partners' => $partners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.partner.create');
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
            'name' => 'required|unique:partners|max:255',
            'description' => 'required',
            'image' => 'required|image',
            'category_id' => 'required',
        ]);

        $partner = new Partner();
        $partner->name = $request->name;
        $partner->url = $request->url;
        if($request->file('image')){
            $partner->image = $request->file('image')->store('partners');
        }
        $partner->save();

        return redirect()->route('admin::partner.index')->with("success","created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        return  view('admin.partner.edit',['partner' => $partner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:partners|max:255',
            'image' => 'required|image',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        $partner->name = $request->name;
        $partner->url = $request->url;
        if($request->file('image')){
            $partner->image = $request->file('image')->store('partners');
        }
        $partner->save();

        return redirect()->route('admin::partner.index')->with("success","updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route('admin::partner.index')->with("success","Deleted");
    }
}
