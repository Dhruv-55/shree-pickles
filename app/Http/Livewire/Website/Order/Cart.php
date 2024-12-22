<?php

namespace App\Http\Livewire\Website\Order;

use App\Models\Cart as ModelsCart;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Cart extends Component
{
    public $cart_items, $user, $remainingForFreeShipping, $progressPercentage;
    public $cartSubtotal = 0;
    public $cartTotal = 0;
    
    public function mount()
    {
        $this->user = Session::get('user');
        $this->cart_items = ModelsCart::where('user_id', $this->user->id)->with('product.variations')->get();
        // dd($this->cart_items);
        // Calculate free shipping progress
        $freeShippingThreshold = 100; // Set your threshold amount
        $this->cartSubtotal = $this->calculateSubtotal();
        $this->remainingForFreeShipping = max(0, $freeShippingThreshold - $this->cartSubtotal);
        $this->progressPercentage = min(100, ($this->cartSubtotal / $freeShippingThreshold) * 100);
        
        // Set cart total (can include shipping if needed)
        $this->cartTotal = $this->cartSubtotal;
    }

    public function decrementQuantity($id)
    {
        $item = ModelsCart::where('id', $id)->first();
        if($item->qty == 1){
            $this->removeItem($id);
        } else {
            $item->decrement('qty');
            $this->refreshCart();
            $this->dispatchBrowserEvent('message', [
                'text' => "Quantity has been updated",
                'type' => 'success'
            ]);
        }
    }

    public function incrementQuantity($id)
    {
        $item = ModelsCart::where('id', $id)->first();
        $product = Product::where('id', $item->product_id)->first();
        \Log::info("Attempting to increment quantity for Cart ID: {$id}");

        if($item->qty >= $product->variationQuantity){
            $this->dispatchBrowserEvent('message', [
                'text' => $product->variationQuantity . " available",
                'type' => 'error'
            ]);
            return;
        }

        $item->increment('qty');
        $this->refreshCart();
        $this->dispatchBrowserEvent('message', [
            'text' => "Quantity has been updated",
            'type' => 'success'
        ]);
    }

    public function removeItem($id)
    {
        ModelsCart::where('id', $id)->delete();
        $this->refreshCart();
        $this->dispatchBrowserEvent('message', [
            'text' => "Item has been removed",
            'type' => 'error'
        ]);
    }

    private function calculateSubtotal()
    {
        return $this->cart_items->sum(function($item) {
            return $item->qty * $item->product->variationPrice['selling_price'];
        });
    }

    private function refreshCart()
    {
        $this->cart_items = ModelsCart::where('user_id', $this->user->id)->get();
        $this->cartSubtotal = $this->calculateSubtotal();
        $this->cartTotal = $this->cartSubtotal;
        
        $freeShippingThreshold = 100;
        $this->remainingForFreeShipping = max(0, $freeShippingThreshold - $this->cartSubtotal);
        $this->progressPercentage = min(100, ($this->cartSubtotal / $freeShippingThreshold) * 100);
    }

    public function proceedToCheckout()
    {
        return redirect()->route('website-checkout');
    }

    public function clearCart()
    {
        ModelsCart::where('user_id', Session::get('user')->id)->delete();
        $this->emit('cartUpdated'); // If you're using cart count updates elsewhere
        $this->refreshCart();
        $this->dispatchBrowserEvent('message', [
            'text' => "Cart has been cleared",
            'type' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.website.order.cart', [
            'cart' => $this->cart_items
        ]);
    }
}
