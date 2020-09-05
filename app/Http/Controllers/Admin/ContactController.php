<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = new Contact();

        if(request('course_id')){
            $contacts = $contacts->where('course_id',request('course_id'));
        }

        if(request('user_id')){
            $contacts = $contacts->where('user_id',request('user_id'));
        }

        $contacts = $contacts->paginate(10);
        return  view('admin.contact.index',['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.contact.create');
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
            'name' => 'required|unique:contacts|max:255',
            'description' => 'required',
            'image' => 'required|image',
            'course_id' => 'required',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->description = $request->description;
        if($request->file('image')){
            $contact->image = $request->file('image')->store('contacts');
        }
        $contact->course_id = $request->course_id;
        $contact->save();

        return redirect()->route('admin::contact.index')->with("success","created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return  view('admin.contact.edit',['contact' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:contacts|max:255',
            'image' => 'required|image',
            'description' => 'required',
            'course_id' => 'required',
        ]);

        $contact->name = $request->name;
        $contact->description = $request->description;
        if($request->file('image')){
            $contact->image = $request->file('image')->store('contacts');
        }
        $contact->course_id = $request->course_id;
        $contact->save();

        return redirect()->route('admin::contact.index')->with("success","updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin::contact.index')->with("success",__('delete'));
    }

    public function reading($id)
    {
        $contact = Contact::find($id);
        $contact->status = 'Reading';
        $contact->save();
        return redirect()->route('admin::contact.index')->with("success",__('approved'));
    }

    public function cancel($id)
    {
        $contact = Contact::find($id);
        $contact->status = 'Cancel';
        $contact->save();
        return redirect()->route('admin::contact.index')->with("success",__('cancel'));
    }

}
