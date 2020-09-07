<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(10);
        return  view('admin.page.index',['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.page.create');
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
            'name' => 'required|unique:pages|max:255',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        $page = new Page();
        $slug = Str::slug($request->name);
        $page->name = $request->name;
        $page->slug = $slug;
        $page->description = $request->description;
        if($request->file('image')){
            $page->image = $request->file('image')->store('pages');
        }
        $page->location = $request->location;
        $page->url = url('/').'page/';
        $page->save();
        $page->url = url('/').'/page/'.$page->id;
        $page->save();
        return redirect()->route('admin::page.index')->with("success","created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return  view('admin.page.edit',['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:pages|max:255',
            'image' => 'required|image',
            'description' => 'required',
        ]);

        $page->name = $request->name;
        $page->slug = Str::slug($request->slug);
        $page->description = $request->description;
        if($request->file('image')){
            $page->image = $request->file('image')->store('pages');
        }
        $page->location = $request->location;
        $page->url = $request->url;
        $page->save();

        return redirect()->route('admin::page.index')->with("success","updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin::page.index')->with("success","Deleted");
    }
}
