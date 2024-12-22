<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::where('user_id',auth()->user()->id)->get();
        return view('user.order.index',compact('orders'));
    }

    public function detail($id){
        $order = Order::find($id);
        return view('user.order.detail',compact('order'));
    }
}
