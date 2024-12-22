<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id',Session::get('user')->id)->with('product.variations')->get();
        
        return view('website.order.cart',[
            'cart' => $cart
        ]);
    }
}
