<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = new Order();

        if(request('course_id')){
            $orders = $orders->where('course_id',request('course_id'));
        }

        if(request('user_id')){
            $orders = $orders->where('user_id',request('user_id'));
        }

        $orders = $orders->paginate(10);
        return  view('admin.order.index',['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.order.create');
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
            'name' => 'required|unique:orders|max:255',
            'description' => 'required',
            'image' => 'required|image',
            'course_id' => 'required',
        ]);

        $order = new Order();
        $order->name = $request->name;
        $order->description = $request->description;
        if($request->file('image')){
            $order->image = $request->file('image')->store('orders');
        }
        $order->course_id = $request->course_id;
        $order->save();

        return redirect()->route('admin::order.index')->with("success","created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return  view('admin.order.edit',['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:orders|max:255',
            'image' => 'required|image',
            'description' => 'required',
            'course_id' => 'required',
        ]);

        $order->name = $request->name;
        $order->description = $request->description;
        if($request->file('image')){
            $order->image = $request->file('image')->store('orders');
        }
        $order->course_id = $request->course_id;
        $order->save();

        return redirect()->route('admin::order.index')->with("success","updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin::order.index')->with("success",__('delete'));
    }

    public function approve($id)
    {
        $order = Order::find($id);
        $order->status = 'approved';
        $order->save();
        return redirect()->route('admin::order.index')->with("success",__('approved'));
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        $order->status = 'cancel';
        $order->save();
        return redirect()->route('admin::order.index')->with("success",__('cancel'));
    }

    public function reject($id)
    {
        $order = Order::find($id);
        $order->status = 'reject';
        $order->save();
        return redirect()->route('admin::order.index')->with("success",__('reject'));
    }
}
