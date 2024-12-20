<?php

namespace App\Http\Livewire\Website\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;

class Detail extends Component
{
    public $product;
    public $quantity = 1;
    public $related_products;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function incrementQuantity()
    {
        $this->quantity++;
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart($productId = null)
    {
        if (!auth()->check()) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Please login to add items to cart'
            ]);
            return;
        }

        // Add to cart logic
        Cart::add($this->product, $this->quantity);
        $this->emit('cartUpdated');
    }

    public function toggleWishlist($productId = null)
    {
        if (!auth()->check()) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Please login to add items to wishlist'
            ]);
            return;
        }

        $this->product->refresh();
    }

    public function redirectToLogin()
    {
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.website.product.detail',[
            'related_products' => $this->related_products,
            'product' => $this->product
        ]);
    }
}
