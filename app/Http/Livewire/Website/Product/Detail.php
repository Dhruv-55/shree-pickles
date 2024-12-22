<?php

namespace App\Http\Livewire\Website\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
class Detail extends Component
{
    public $product;
    public $quantity = 1;
    public $related_products;
    public $cartItem = null;
    public $selectedVariation = null;
    public $currentPrice;
    public $prices;

    public function mount(Product $product)
    {
        $this->product = $product;
        
        // Check if product is in cart
        if (Session::has('user')) {
            $this->cartItem = Cart::where('user_id', Session::get('user')->id)
                                 ->where('product_id', $this->product->id)
                                 ->first();
            
            if ($this->cartItem) {
                $this->quantity = $this->cartItem->qty;
                $this->selectedVariation = $this->cartItem->variation_id;
                if ($this->selectedVariation) {
                    $variation = $this->product->variations()->find($this->selectedVariation);
                    if ($variation) {
                        $this->updateCurrentPrice($variation);
                    }
                }
            }
        }
        
        // Initialize prices array for all variations
        $this->prices = collect($product->variations)->mapWithKeys(function($variation) {
            return [$variation->id => [
                'selling_price' => $variation->selling_price,
                'original_price' => $variation->original_price ?? $variation->selling_price
            ]];
        })->toArray();
        
        // Set default variation if available
        if (!$this->selectedVariation && $product->variations && $product->variations->count() > 0) {
            $defaultVariation = $product->variations->first();
            $this->selectedVariation = $defaultVariation->id;
            $this->currentPrice = $this->prices[$defaultVariation->id];
        } else if (!$this->selectedVariation) {
            $this->currentPrice = [
                'selling_price' => $product->selling_price ?? 0,
                'original_price' => $product->original_price ?? 0
            ];
        }

        // Get related products
        $this->related_products = Product::where('category_id', $product->category_id)
                                       ->where('id', '!=', $product->id)
                                       ->take(4)
                                       ->get();
    }

    protected function updateCurrentPrice($variation)
    {
        $this->currentPrice = [
            'selling_price' => $variation->selling_price ?? 0,
            'original_price' => $variation->original_price ?? $variation->selling_price ?? 0
        ];
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
        if (!Session::has('user')) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Please login to add items to cart'
            ]);
            return;
        }

        if ($this->product->hasVariations() && !$this->selectedVariation) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Please select a variation'
            ]);
            return;
        }

        $cart = Cart::updateOrCreate(
            [
                'user_id' => Session::get('user')->id,
                'product_id' => $this->product->id,
                'variation_id' => $this->selectedVariation
            ],
            [
                'qty' => $this->quantity,
            ]
        );

        $this->cartItem = $cart;
        $this->emit('cartUpdated');
        
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Product added to cart successfully'
        ]);
    }

    public function toggleWishlist($productId = null)
    {
        if (!Session::has('user')) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Please login to add items to wishlist'
            ]);
            return;
        }

        // Toggle wishlist with database operations
        $this->product->wishlist()->toggle(Session::get('user')->id);
        $this->product->refresh();
        
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Wishlist updated successfully'
        ]);
    }

    public function redirectToLogin()
    {
        return redirect()->route('website-auth-login');
    }

    public function incrementCartItem()
    {
        if ($this->cartItem) {
            $this->cartItem->increment('qty');
            $this->cartItem->refresh();
            $this->quantity = $this->cartItem->qty;
            $this->emit('cartUpdated');
        }
    }

    public function decrementCartItem()
    {
        if ($this->cartItem && $this->cartItem->qty > 1) {
            $this->cartItem->decrement('qty');
            $this->cartItem->refresh();
            $this->quantity = $this->cartItem->qty;
            $this->emit('cartUpdated');
        } else if ($this->cartItem) {
            $this->cartItem->delete();
            $this->cartItem = null;
            $this->quantity = 1;
            $this->emit('cartUpdated');
        }
    }

    public function selectVariation($value)
    {
        $this->selectedVariation = $value;
        
        if ($value) {
            // Update the current price based on the selected variation
            if (isset($this->prices[$value])) {
                $this->currentPrice = $this->prices[$value];
            }
        }
    }

    public function updatedSelectedVariation($variationId)
    {
        if ($variationId) {
            if (isset($this->prices[$variationId])) {
                $this->currentPrice = $this->prices[$variationId];
            }

            if ($this->cartItem) {
                $this->cartItem->update(['variation_id' => $variationId]);
                $this->cartItem->refresh();
            }
        }
    }

    public function render()
    {
        return view('livewire.website.product.detail', [
            'related_products' => $this->related_products,
            'product' => $this->product,
            'currentPrice' => $this->currentPrice
        ]);
    }
}
