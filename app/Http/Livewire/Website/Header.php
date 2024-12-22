<?php

namespace App\Http\Livewire\Website;

use App\Models\Cart;
use App\Models\Wishlist;
use COM;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Models\Category;
class Header extends Component
{
    public $cart_items = [];
    public $user;
    public $wishlist_items = [];
    public $cart_count = 0;
    public $cart_subtotal = 0;
    public $categories;

    protected $listeners = ['cartUpdated' => 'updateCart'];

    public function mount()
    {
        $this->user = Session::get('user')->id ?? null;

        if ($this->user) {
            $this->cart_items = Cart::where('user_id', $this->user)->get();
            $this->cart_count = $this->cart_items->count();
            $this->cart_subtotal = $this->cart_items->sum(function($item) {
                return $item->product->variationPrice['selling_price'] * $item->qty;
            });
            $this->wishlist_items = Wishlist::where('user_id', $this->user)->get();
        }
        $this->categories = Category::where('parent_id', null)
            ->with('subcategories')
            ->get();
    }
    
    public function updateCart()
    {
        if ($this->user) {
            $this->cart_items = Cart::where('user_id', $this->user)->get();
            $this->cart_count = $this->cart_items->count();
            $this->cart_subtotal = $this->cart_items->sum(function($item) {
                return $item->product->variationPrice['selling_price'] * $item->qty;
            });
        }
    }

    public function render()
    {
        return view('livewire.website.header', [
            'cart_items' => $this->cart_items,
            'wishlist_items' => $this->wishlist_items,
            'categories' => $this->categories,
        ]);
    }

    public function emitCartUpdated()
    {
        $this->emit('cartUpdated');
    }

    public function removeFromCart($rowId)
    {
        try {
            // Remove the item from the database
            $cart = Cart::find($rowId);
            // dd($cart);
            if ($cart) {
                $cart->delete();
                
                // Update the cart counts and totals
                $this->updateCart();
                
                // Optional: Add success message
                session()->flash('success', 'Item removed from cart');
            }
        } catch (\Exception $e) {
            // Handle any errors
            session()->flash('error', 'Could not remove item from cart');
        }
    }
}
