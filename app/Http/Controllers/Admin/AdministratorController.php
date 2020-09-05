<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Administrator;

class AdministratorController extends Controller
{

    public function index()
    {
        $administrators = new Administrator();

        if(request('name')){
            $administrators = $administrators->where('firstname', 'like', '%' . request('name') . '%')->orWhere('lastname', 'like', '%' . request('name') . '%');
        }

        if(request('email')){
            $administrators = $administrators->where('email', 'like', '%' . request('email') . '%');
        }

        if(request('mobile')){
            $administrators = $administrators->where('mobile', 'like', '%' . request('mobile') . '%');
        }

        if(request('status')){
            $administrators = $administrators->where('status',request('status'));
        }

        if(request('id')){
            $administrators = $administrators->where('id',request('id'));
        }

        $administrators = $administrators->latest()->paginate(15);

        return view( 'admin.administrator.index' , [
            'administrators' => $administrators ,
        ]);
    }

    public function create()
    {
        return view( 'admin.administrator.create' , []);
    }
    public function store( Request $request )
    {

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:administrators',
            //'mobile' => 'required|unique:administrators',
            'password' => 'required|confirmed|min:6',
        ]);


        $inputs = $request->input();

        $inputs['password'] = bcrypt($request->password);


        $administrator = Administrator::create($inputs);

        return redirect()->route('admin::administrator.index')->with('success',__('added'));
    }

    public function edit( $id = 0 )
    {
    	$administrator = Administrator::find($id);

        return view( 'admin.administrator.edit' , [
        	'administrator' => $administrator ,
        ]);
    }

    public function update( $id , Request $request )
    {

        $administrator = Administrator::find($id);

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'string|email|max:255|unique:administrators,email,'.$administrator->id,
            //'mobile' => 'max:255|unique:administrators,mobile,'.$administrator->id,
            //'password' => request('password') ? 'required|min:6' : '',

        ]);

        $inputs = $request->input();
        $inputs['status'] = $request->status == "on" ? 1 : 0;
        if($request->password){
            $inputs['password'] = bcrypt($request->password);
        }else{
            unset($inputs['password']);
        }

        $administrator->update($inputs);


        return redirect()->route('admin::administrator.index')->with('success',__('editDon'));
    }


    public function destroy( $id )
    {
        if( !$id ){
            return redirect( route('admin::administrator.index') )->withErrors(['errorSelected']);
        }
        $administrator = Administrator::find($id);
        if( $administrator->id == 1 ){
            return redirect( route('admin::administrator.index') )->withErrors([__('errorDeletAdministrator')]);
        }

        $administrator->delete();
        return redirect( route('admin::administrator.index') )->with('success',__('deleted'));
    }

}
