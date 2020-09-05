<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = new Email();

        if(request('download')){

            $data = "";
            foreach($emails->get() as $email) {
                $data .= $email->email."\n";
            }

            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="filename.csv"');
            echo $data; die();

        }

        $emails = $emails->paginate(10);
        return  view('admin.email.index',['emails' => $emails]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.email.create');
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
            'name' => 'required|unique:emails|max:255',
            'description' => 'required',
            'image' => 'required|image',
            'course_id' => 'required',
        ]);

        $email = new Email();
        $email->name = $request->name;
        $email->description = $request->description;
        if($request->file('image')){
            $email->image = $request->file('image')->store('emails');
        }
        $email->course_id = $request->course_id;
        $email->save();

        return redirect()->route('admin::email.index')->with("success","created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        return  view('admin.email.edit',['email' => $email]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:emails|max:255',
            'image' => 'required|image',
            'description' => 'required',
            'course_id' => 'required',
        ]);

        $email->name = $request->name;
        $email->description = $request->description;
        if($request->file('image')){
            $email->image = $request->file('image')->store('emails');
        }
        $email->course_id = $request->course_id;
        $email->save();

        return redirect()->route('admin::email.index')->with("success","updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        $email->delete();
        return redirect()->route('admin::email.index')->with("success",__('delete'));
    }

    public function approve($id)
    {
        $email = Email::find($id);
        $email->status = 'approved';
        $email->save();
        return redirect()->route('admin::email.index')->with("success",__('approved'));
    }

    public function cancel($id)
    {
        $email = Email::find($id);
        $email->status = 'cancel';
        $email->save();
        return redirect()->route('admin::email.index')->with("success",__('cancel'));
    }

    public function reject($id)
    {
        $email = Email::find($id);
        $email->status = 'reject';
        $email->save();
        return redirect()->route('admin::email.index')->with("success",__('reject'));
    }
}
