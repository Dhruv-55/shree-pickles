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
            'zip_code' => 'required',
            'country' => 'required',
            'payment_mode' => 'required|in:' . Order::COD . ',' . Order::ONLINE,
        ]);

        try {
            DB::beginTransaction();
            
            // Calculate total from cart items first
            $cartItems = Cart::where('user_id', Session::get('user')->id)->with('product')->get();
            $total = $cartItems->sum(function($item) {
                return $item->qty * $item->product->variationPrice['selling_price'];
            });

            // Create the order with all required fields
            $order = Order::create([
                'user_id' => Session::get('user')->id,
                'tracking_number' => 'ORD-' . uniqid(),
                'address' => [
                    'email' => $request->email,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip_code' => $request->zip_code,
                    'country' => $request->country,
                ],
                'payment_mode' => $request->payment_mode,
                'status' => Order::PLACED,
                'total' => $total,
                'amount' => $total,
                'discount_amount' => 0
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->qty,
                    'price' => $item->product->variationPrice['selling_price'],
                ]);
            }

            // Clear the cart
            Cart::where('user_id', Session::get('user')->id)->delete();

            DB::commit();
            
            return redirect()->route('website-order-success')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            // Add detailed error logging
            \Log::error('Order creation failed: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }

    }
    
    public function success(){
        $order = Order::where('user_id', Session::get('user')->id)->latest()->first();
        return view('website.order.success', compact('order'));
    }
}
