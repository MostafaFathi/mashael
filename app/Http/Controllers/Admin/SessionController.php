<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::where('id','>',10)->paginate(10);
        return view('admin.session.index', ['sessions' => $sessions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.session.create');
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
            'name' => 'required|unique:sessions|max:255',
        ]);

        $session = new Session();
        $session->name = $request->name;
        $session->trainer_id = $request->trainer_id;
        $session->description = $request->description;
        $session->price = $request->price ? $request->price : 0;
        $session->date_time = $request->date_time ;
        $session->date_time_end = $request->date_time_end ;
        $session->contact_by = $request->contact_by ;
        $session->address = $request->address ;

        $session->save();

        return redirect()->route('admin::session.index')->with("success", "created");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Session $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Session $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        return view('admin.session.edit', ['session' => $session]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Session $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:sessions,'.$session->id,

        ]);

        $session->name = $request->name;
        $session->trainer_id = $request->trainer_id;
        $session->description = $request->description;
        $session->price = $request->price ? $request->price : 0;
        $session->date_time = $request->date_time;
        $session->date_time_end = $request->date_time_end;
        $session->contact_by = $request->contact_by;
        $session->address = $request->address;

        $session->save();

        return redirect()->route('admin::session.index')->with("success", "updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Session $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        $session->delete();
        return redirect()->route('admin::session.index')->with("success", "Deleted");
    }
}
