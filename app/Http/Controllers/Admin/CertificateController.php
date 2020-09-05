<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates =  Certificate::paginate(10);
        return  view('admin.certificate.index',['certificates' => $certificates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.certificate.create');
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
            'name' => 'required|unique:certificates|max:255',
            'description' => 'required',
            'image' => 'required|image',
            'category_id' => 'required',
        ]);

        $certificate = new Certificate();
        $certificate->name = $request->name;
        $certificate->url = $request->url;
        $certificate->trainer_id = 1;
        if($request->file('image')){
            $certificate->image = $request->file('image')->store('certificates');
        }
        $certificate->save();

        return redirect()->route('admin::certificate.index')->with("success","created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function show(Certificate $certificate)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function edit(Certificate $certificate)
    {
        return  view('admin.certificate.edit',['certificate' => $certificate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certificate $certificate)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:certificates|max:255',
            'image' => 'required|image',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        $certificate->name = $request->name;
        $certificate->url = $request->url;
        $certificate->trainer_id = 1;
        if($request->file('image')){
            $certificate->image = $request->file('image')->store('certificates');
        }
        $certificate->save();

        return redirect()->route('admin::certificate.index')->with("success","updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return redirect()->route('admin::certificate.index')->with("success","Deleted");
    }
}
