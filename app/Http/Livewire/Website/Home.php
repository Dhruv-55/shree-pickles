<?php

namespace App\Http\Livewire\Website;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Home extends Component
{
    public $categories;
    public $products;   
    public $latest_products;
    public $trending_products;
    public $best_seller;
    public $new_arrivals;
    public $sliders;
    public $quantity = [];
    public $cartQuantity = [];

    public function mount()
    {
        $this->quantity = [];

        // Get user's cart items if logged in
        $cartItems = [];
        if (Session::has('user')) {
            $cartItems = Cart::where('user_id', Session::get('user')->id)
                ->get()
                ->pluck('qty', 'product_id')
                ->toArray();
                
        }

        // Initialize quantities for all product collections
        $allProducts = collect()
            ->merge($this->products ?? [])
            ->merge($this->latest_products ?? [])
            ->merge($this->trending_products ?? [])
            ->merge($this->best_seller ?? [])
            ->merge($this->new_arrivals ?? []);

        foreach ($allProducts->unique('id') as $product) {
            // Set quantity to cart quantity if exists, otherwise 0
            $this->quantity[$product->id] = $cartItems[$product->id] ?? 0;
        }
    }

    public function incrementQuantity($productId)
    {
        if (!Session::has('user')) {
            return redirect()->route('website-auth-login');
        }

        if (isset($this->quantity[$productId])) {
            $this->quantity[$productId]++;
            
            // Update or create cart entry
            Cart::updateOrCreate(
                [
                    'user_id' => Session::get('user')->id,
                    'product_id' => $productId
                ],
                ['qty' => $this->quantity[$productId]]
            );
        }
    }

    public function decrementQuantity($productId)
    {
        if (!Session::has('user')) {
            return redirect()->route('website-auth-login');
        }

        if (isset($this->quantity[$productId]) && $this->quantity[$productId] > 0) {
            $this->quantity[$productId]--;
            
            if ($this->quantity[$productId] === 0) {
                // Remove from database if quantity is 0
                Cart::where('user_id', Session::get('user')->id)
                    ->where('product_id', $productId)
                    ->delete();
                    
                unset($this->quantity[$productId]);
            } else {
                // Update quantity in database
                Cart::where('user_id', Session::get('user')->id)
                    ->where('product_id', $productId)
                    ->update(['qty' => $this->quantity[$productId]]);
            }
        }
    }

    public function addToCart($productId)
    {
        if (!Session::has('user')) {
            return redirect()->route('website-auth-login');
        }

        $this->quantity[$productId] = 1;
        
        // Add to database
        Cart::updateOrCreate(
            [
                'user_id' => Session::get('user')->id,
                'product_id' => $productId
            ],
            ['qty' => 1]
        );
    }

    public function render()
    {
        return view('livewire.website.home',[
            'categories' => $this->categories,
            'products' => $this->products,
            'latest_products' => $this->latest_products,
            'trending_products' => $this->trending_products,
            'best_seller' => $this->best_seller,
            'new_arrivals' => $this->new_arrivals,
            'sliders' => $this->sliders
        ]);
    }
}
