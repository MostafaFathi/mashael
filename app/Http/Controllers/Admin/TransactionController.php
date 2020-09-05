<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = new Transaction();

        if(request('course_id')){
            $transactions = $transactions->where('course_id',request('course_id'));
        }

        if(request('user_id')){
            $transactions = $transactions->where('user_id',request('user_id'));
        }

        $transactions = $transactions->paginate(10);
        return  view('admin.transaction.index',['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.transaction.create');
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
            'name' => 'required|unique:transactions|max:255',
            'description' => 'required',
            'image' => 'required|image',
            'course_id' => 'required',
        ]);

        $transaction = new Transaction();
        $transaction->name = $request->name;
        $transaction->description = $request->description;
        if($request->file('image')){
            $transaction->image = $request->file('image')->store('transactions');
        }
        $transaction->course_id = $request->course_id;
        $transaction->save();

        return redirect()->route('admin::transaction.index')->with("success","created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return  view('admin.transaction.edit',['transaction' => $transaction]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:transactions|max:255',
            'image' => 'required|image',
            'description' => 'required',
            'course_id' => 'required',
        ]);

        $transaction->name = $request->name;
        $transaction->description = $request->description;
        if($request->file('image')){
            $transaction->image = $request->file('image')->store('transactions');
        }
        $transaction->course_id = $request->course_id;
        $transaction->save();

        return redirect()->route('admin::transaction.index')->with("success","updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('admin::transaction.index')->with("success",__('delete'));
    }

    public function approve($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 'approved';
        $transaction->save();
        return redirect()->route('admin::transaction.index')->with("success",__('approved'));
    }

    public function cancel($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 'cancel';
        $transaction->save();
        return redirect()->route('admin::transaction.index')->with("success",__('cancel'));
    }

    public function reject($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 'reject';
        $transaction->save();
        return redirect()->route('admin::transaction.index')->with("success",__('reject'));
    }
}
