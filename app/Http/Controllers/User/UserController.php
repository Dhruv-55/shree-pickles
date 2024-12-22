<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
class UserController extends Controller
{
    public function index(Request $requst){
        $user = Session::get('user');
        $orders = Order::where('user_id',$user->id)->get();
        return view('user.dashboard',compact('user','orders'));
    }
}
