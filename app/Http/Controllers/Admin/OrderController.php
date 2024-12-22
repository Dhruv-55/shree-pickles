<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CancelOrder;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){
        return view('admin.order.index',[
            'orders' => Order::with(['user','items'])->paginate(20)
        ]);
    }

    public function update(Request $request){

        if(! $order = Order::where('id',$request->id)->first())
            return redirect()->back()->with(['error' => 'Order not found']);

        if($request->isMethod('POST')){
            $order->status = $request->status;
          
            $timestampFields = [
                2 => 'dispatched_at',
                3 => 'shipped_at',
                4 => 'approved_at',
                5 => 'canceled_at'
            ];

            if (array_key_exists($request->status, $timestampFields)) {
                $order->{$timestampFields[$request->status]} = now();
            }

            $order->save();
            
            return redirect()->route('admin-order-view')->with(['success' => 'Order status has been updated']);
        }

        return view('admin.order.update',[
            'order' => $order
        ]);
    }
    public function cancel(Request $request){
        return view('admin.order.cancel.index',[
            'cancel_orders' => CancelOrder::all()
        ]);
    }
}
