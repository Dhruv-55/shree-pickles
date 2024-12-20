<?php

namespace App\Http\Livewire\Website;

use App\Models\Cart;
use App\Models\Wishlist;
use COM;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Header extends Component
{
    public $cart_items = [];
    public $user;
    public $wishlist_items = [];
    public $cart_count = 0;
    public $cart_subtotal = 0;

    public function mount()
    {
        $this->user = Session::get('user')->id ?? null;

        if ($this->user) {
            $this->cart_items = Cart::where('user_id', $this->user)->get();
            $this->cart_count = $this->cart_items->count();
            $this->cart_subtotal = $this->cart_items->sum('total_amount');
            $this->wishlist_items = Wishlist::where('user_id', $this->user)->get();
        }
    }
    
    protected $listeners = ['cartUpdated' => 'updateCart'];

    public function updateCart()
    {
        if ($this->user) {
            $this->cart_items = Cart::where('user_id', $this->user)->get();
            $this->cart_count = $this->cart_items->count();
            $this->cart_subtotal = $this->cart_items->sum('total_amount');
        }
    }

    public function render()
    {
        return view('livewire.website.header', [
            'cart_items' => $this->cart_items,
            'wishlist_items' => $this->wishlist_items,
        ]);
    }

    public function emitCartUpdated()
    {
        $this->emit('cartUpdated');
    }
}
