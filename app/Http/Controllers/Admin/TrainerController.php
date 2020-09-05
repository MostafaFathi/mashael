<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trainer;

class TrainerController extends Controller
{

    public function index()
    {
        $trainers = new Trainer();

        if (request('name')) {
            $trainers = $trainers->where('firstname', 'like', '%' . request('name') . '%')->orWhere('lastname', 'like', '%' . request('name') . '%');
        }

        if (request('email')) {
            $trainers = $trainers->where('email', 'like', '%' . request('email') . '%');
        }

        if (request('mobile')) {
            $trainers = $trainers->where('mobile', 'like', '%' . request('mobile') . '%');
        }

        if (request('status')) {
            $trainers = $trainers->where('status', request('status'));
        }

        if (request('id')) {
            $trainers = $trainers->where('id', request('id'));
        }

        $trainers = $trainers->latest()->paginate(15);

        return view('admin.trainer.index', [
            'trainers' => $trainers,
        ]);
    }

    public function create()
    {
        return view('admin.trainer.create', []);
    }

    public function store(Request $request)
    {

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:trainers',
            //'mobile' => 'required|unique:trainers',
            'password' => 'required|confirmed|min:6',
        ]);


        $inputs = $request->input();

        $inputs['password'] = bcrypt($request->password);


        $inputs['mobile'] = $request->mobile ? $request->mobile : "";
        $inputs['status'] = $request->status ? "Active" : "Inactive";

        $trainer = Trainer::create($inputs);

        return redirect()->route('admin::trainer.index')->with('success', __('added'));
    }

    public function edit($id = 0)
    {
        $trainer = Trainer::find($id);

        return view('admin.trainer.edit', [
            'trainer' => $trainer,
        ]);
    }

    public function update($id, Request $request)
    {

        $trainer = Trainer::find($id);

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'string|email|max:255|unique:trainers,email,' . $trainer->id,
            //'mobile' => 'max:255|unique:trainers,mobile,'.$trainer->id,
            //'password' => request('password') ? 'required|min:6' : '',

        ]);

        $inputs = $request->input();

        if ($request->password) {
            $inputs['password'] = bcrypt($request->password);
        } else {
            unset($inputs['password']);
        }

        $inputs['status'] = $request->status ? "Active" : "Inactive";

        $trainer->update($inputs);


        return redirect()->route('admin::trainer.index')->with('success', __('editDon'));
    }


    public function destroy($id)
    {
        if (!$id) {
            return redirect(route('admin::trainer.index'))->withErrors(['errorSelected']);
        }
        $trainer = Trainer::find($id);
        if ($trainer->id == 1) {
            return redirect(route('admin::trainer.index'))->withErrors([__('TrrorDelettrainer')]);
        }

        $trainer->delete();
        return redirect(route('admin::trainer.index'))->with('success', __('deleted'));
    }

}
