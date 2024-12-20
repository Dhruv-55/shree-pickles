<?php

namespace App\Http\Livewire\Website\Product;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class Index extends Component
{

    public $products,$categories,$category_input=[],$user,$product;
    public $search,$cart_qty;
    public $quantities = [];
    public $quantity = [];
    public $brands;
    public $selectedCategory = '';
    public $selectedBrand = '';
    public $selectedVariation = '';
    public $minPrice = 0;
    public $maxPrice = 150;
    public $minAvailablePrice;
    public $maxAvailablePrice;
    public $priceRange;
    public $selectedCategories = [];

    public function __construct($user)
    {
        $this->user = Session::get('user');
    }

    protected $queryString = [
        'category_input' => ['except','as' => 'category'],
        'search' => ['except','as' => 'search']
    ];


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


    public function mount($products,$categories,$search=null){
        $this->products = $products;
        $this->categories = $categories;
        $this->search = $search;

        // Get user's cart items if logged in
        $cartItems = [];
        if (Session::has('user')) {
            $cartItems = Cart::where('user_id', Session::get('user')->id)
                ->get()
                ->pluck('qty', 'product_id')
                ->toArray();
        }

        // Initialize quantities for all products
        foreach ($this->products as $product) {
            $this->quantity[$product->id] = $cartItems[$product->id] ?? 0;
        }

        $this->loadProducts(); // Load initial products

        // Get the min and max prices from your products table
        $this->minAvailablePrice = Product::min('selling_price') ?? 0;
        $this->maxAvailablePrice = Product::max('selling_price') ?? 150;
        
        // Set initial values
        $this->minPrice = $this->minAvailablePrice;
        $this->maxPrice = $this->maxAvailablePrice;
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

    public function applyFilter()
    {
        // The render method will automatically apply all filters
    }

    public function resetFilter()
    {
        $this->reset([
            'selectedCategory', 
            'selectedBrand', 
            'selectedVariation',
            'selectedCategories',
            'minPrice',
            'maxPrice'
        ]);
        
        // Reset price range to initial values
        $this->minPrice = $this->minAvailablePrice;
        $this->maxPrice = $this->maxAvailablePrice;
    }

    public function applyPriceFilter()
    {
        // The render method will automatically apply the price filter
    }

    // Add this method to help debug
    public function updatedSelectedCategory()
    {
        \Log::info('Category changed to: ' . $this->selectedCategory);
    }

    public function updatedSelectedBrand()
    {
        \Log::info('Brand changed to: ' . $this->selectedBrand);
    }

    public function updatedSelectedVariation()
    {
        \Log::info('Variation changed to: ' . $this->selectedVariation);
    }

    private function loadProducts()
    {
        $query = Product::query();

        // Apply category input filter
        if ($this->category_input) {
            $query->whereIn('category_id', $this->category_input);
        }

        // Apply search filter
        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'LIKE', "%{$this->search}%")
                  ->orWhereHas('category', function($q) {
                      $q->where('name', 'LIKE', "%{$this->search}%");
                  });
            });
        }

        // Apply selected categories filter
        if (!empty($this->selectedCategories)) {
            $query->whereIn('category_id', $this->selectedCategories);
        }

        // Apply single category filter
        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        // Apply brand filter
        if ($this->selectedBrand) {
            $query->where('brand_id', $this->selectedBrand);
        }

        // Apply variation filter
        if ($this->selectedVariation) {
            $query->where('qty_type', $this->selectedVariation);
        }

        // Apply price filter
        if ($this->minPrice && $this->maxPrice) {
            $query->whereBetween('selling_price', [$this->minPrice, $this->maxPrice]);
        }

        // Get the filtered products
        $this->products = $query->get();
    }

    public function render()
    {
        $this->loadProducts();

        // Load brands if not already loaded
        if (!$this->brands) {
            $this->brands = \App\Models\Brand::all();
        }

        return view('livewire.website.product.index', [
            'products' => $this->products,
            'categories' => $this->categories,
            'brands' => $this->brands
        ]);
    }
}
