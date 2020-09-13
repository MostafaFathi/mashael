<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Session;
use App\SessionType;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $sessionTypes = SessionType::all();
        $timeInterval = ['12-1','1-2','2-3','3-4','4-5','5-6','6-7','7-8','8-9','9-10'];
        return view('admin.session.create',compact('sessionTypes','timeInterval'));
    }

    public function checkInterval()
    {

        $sessions = Session::wheredate('date_time',\request()->date)->get();
        $timeInterval = ['12-1','1-2','2-3','3-4','4-5','5-6','6-7','7-8','8-9','9-10'];

        foreach ($sessions as $session) {
            foreach ($timeInterval as $key => $item) {
                if(\request()->has('update')){
                    $sessionItem = \request('session');
                    if($session->interval_time == $item and  $sessionItem['interval_time'] != $session->interval_time){
                        Arr::pull($timeInterval,$key);
                    }
                }else{
                    if($session->interval_time == $item){
                        Arr::pull($timeInterval,$key);
                    }
                }

            }
        }
        $generatedOptions = '';
        foreach ($timeInterval as $item) {
            if(\request()->has('update')) {
                $sessionItem = \request('session');
                if($sessionItem['interval_time'] == $item){
                    $generatedOptions.="<option selected value='$item'>$item مساءاً </option>";
                }else{
                    $generatedOptions.="<option value='$item'>$item مساءاً </option>";
                }
            }else{
                $generatedOptions.="<option value='$item'>$item مساءاً </option>";
            }
        }
        echo json_encode($generatedOptions);
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
        $sessionType = SessionType::find($request->session_type);
        $session = new Session();
        $session->name = $request->name;
        $session->trainer_id = $request->trainer_id;
        $session->description = $request->description;
        $session->session_type = $request->session_type;
        $session->price = $sessionType->price ?? 0;
        $session->date_time = $request->date_time ;
        $session->interval_time = $request->interval_time ;
        $session->coordinates = $request->coordinates ;
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
        $sessionTypes = SessionType::all();
        $sessions = Session::wheredate('date_time',$session->date_time)->get();
        $timeInterval = ['12-1','1-2','2-3','3-4','4-5','5-6','6-7','7-8','8-9','9-10'];
        foreach ($sessions as $sessionItem) {
            foreach ($timeInterval as $key => $item) {
                if($sessionItem->interval_time == $item and $session->interval_time != $sessionItem->interval_time){
                    Arr::pull($timeInterval,$key);
                }
            }
        }
        return view('admin.session.edit', ['session' => $session,'sessionTypes'=>$sessionTypes,'timeInterval'=>$timeInterval]);
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
        $sessionType = SessionType::find($request->session_type);

        $session->name = $request->name;
        $session->trainer_id = $request->trainer_id;
        $session->description = $request->description;
        $session->session_type = $request->session_type;
        $session->price = $sessionType->price ?? 0;
        $session->interval_time = $request->interval_time ;
        $session->coordinates = $request->coordinates ;
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
