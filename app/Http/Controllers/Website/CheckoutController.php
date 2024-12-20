<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        if($request->isMethod('post')){
            return $this->placeOrder($request);
        }
        $cart_items = Cart::where('user_id', Session::get('user')->id)->with('product')->get();
        
        // Calculate cart total
        $cart_total = $cart_items->sum('total_amount');

        return view('website.order.checkout', [
            'cart_items' => $cart_items,
            'cart_total' => $cart_total
        ]);
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
        ]);

        try {
            DB::beginTransaction();
            
            // Create the order
            $order = Order::create([
                'user_id' => Session::get('user')->id,
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => $request->country,
                'status' => 'pending',
            ]);

            // Get cart items and create order items
            $cartItems = Cart::where('user_id', Session::get('user')->id)->get();
            $total = 0;

            foreach ($cartItems as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
                $total += $item->quantity * $item->product->price;
            }

            $order->update(['total' => $total]);

            // Process payment (implement your payment gateway logic here)
            // $payment = PaymentGateway::process($total);

            // Clear the cart
            Cart::where('user_id', Session::get('user')->id)->delete();

            DB::commit();

            return redirect()->route('order.success')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
