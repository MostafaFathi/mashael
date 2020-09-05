<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function index()
    {
        $users = new User();

        if(request('name')){
            $users = $users->where('firstname', 'like', '%' . request('name') . '%')->orWhere('lastname', 'like', '%' . request('name') . '%');
        }

        if(request('email')){
            $users = $users->where('email', 'like', '%' . request('email') . '%');
        }

        if(request('mobile')){
            $users = $users->where('mobile', 'like', '%' . request('mobile') . '%');
        }

        if(request('status')){
            $users = $users->where('status',request('status'));
        }

        if(request('id')){
            $users = $users->where('id',request('id'));
        }

        $users = $users->latest()->paginate(15);

        return view( 'admin.user.index' , [
            'users' => $users ,
        ]);
    }

    public function create()
    {
        return view( 'admin.user.create' , []);
    }
    public function store( Request $request )
    {

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users',
            //'mobile' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);


        $inputs = $request->input();

        $inputs['password'] = bcrypt($request->password);


        $user = User::create($inputs);

        return redirect()->route('admin::user.index')->with('success',__('added'));
    }

    public function edit( $id = 0 )
    {
    	$user = User::find($id);

        return view( 'admin.user.edit' , [
        	'user' => $user ,
        ]);
    }

    public function update( $id , Request $request )
    {

        $user = User::find($id);

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'string|email|max:255|unique:users,email,'.$user->id,
            //'mobile' => 'max:255|unique:users,mobile,'.$user->id,
            //'password' => request('password') ? 'required|min:6' : '',

        ]);

        $inputs = $request->input();

        if($request->password){
            $inputs['password'] = bcrypt($request->password);
        }else{
            unset($inputs['password']);
        }

        if($request->status){
            $inputs['status'] = 'Active';
        }else{
            $inputs['status'] = 'Inactive';
        }

        $user->update($inputs);


        return redirect()->route('admin::user.index')->with('success',__('editDon'));
    }


    public function destroy( $id )
    {
        if( !$id ){
            return redirect( route('admin::user.index') )->withErrors(['errorSelected']);
        }
        $user = User::find($id);
        if( $user->id == 1 ){
            return redirect( route('admin::user.index') )->withErrors([__('TrrorDeletuser')]);
        }

        $user->delete();
        return redirect( route('admin::user.index') )->with('success',__('deleted'));
    }

}
