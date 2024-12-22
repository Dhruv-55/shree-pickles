<?php

namespace App\Http\Livewire\Website\Product;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\ProductVariation;

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
    public $selectedBrands = [];
    public $categorySlug;
    public $variations;
    public $selectedVariations = [];

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

        // Check if a variation is selected, if not, select the first available variation
        $variationId = $this->selectedVariation ?: ProductVariation::where('product_id', $productId)->first()->id;

        $this->quantity[$productId] = 1;
        
        // Add to database
        Cart::updateOrCreate(
            [
                'user_id' => Session::get('user')->id,
                'product_id' => $productId,
                'variation_id' => $variationId
            ],
            ['qty' => 1]
        );

        // Emit the cart updated event
        $this->emit('cartUpdated');
    }


    public function mount($products, $categories, $search=null, $categorySlug=null) {
        $this->categories = $categories;
        $this->search = $search;
        $this->categorySlug = $categorySlug;

        // Get user's cart items if logged in
        $cartItems = [];
        if (Session::has('user')) {
            $cartItems = Cart::where('user_id', Session::get('user')->id)
                ->get()
                ->pluck('qty', 'product_id')
                ->toArray();
        }

        // Load products based on category slug
        if ($this->categorySlug) {
            $this->products = Product::with(['category'])
                ->whereHas('category', function($q) {
                    $q->where('slug', $this->categorySlug);
                })
                ->get();
            
            // Set selected category
            $category = Category::where('slug', $this->categorySlug)->first();
            if ($category) {
                $this->selectedCategories = [$category->id];
            }
        } else {
            $this->products = $products;
        }

        // Initialize quantities for all products
        foreach ($this->products as $product) {
            $this->quantity[$product->id] = $cartItems[$product->id] ?? 0;
        }

        // Update to get min/max prices from product_variations table
        $this->minAvailablePrice = DB::table('product_variations')->min('selling_price') ?? 0;
        $this->maxAvailablePrice = DB::table('product_variations')->max('selling_price') ?? 150;
        
        // Set initial values
        $this->minPrice = $this->minAvailablePrice;
        $this->maxPrice = $this->maxAvailablePrice;
        $this->priceRange = $this->maxPrice;

        // Initialize variations
        $this->variations = ProductVariation::variations();
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
                    'product_id' => $productId,
                    'variation_id' => $this->selectedVariation
                ],
                ['qty' => $this->quantity[$productId]]
            );

            // Emit the cart updated event
            $this->emit('cartUpdated');
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

            // Emit the cart updated event
            $this->emit('cartUpdated');
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
            'selectedBrands',
            'selectedVariations',
            'minPrice',
            'maxPrice'
        ]);
        
        // Reset price range to initial values
        $this->minPrice = $this->minAvailablePrice;
        $this->maxPrice = $this->maxAvailablePrice;
    }

    // Add this new method
    public function updatedPriceRange($value)
    {
        $this->maxPrice = (int)$value;
        $this->loadProducts();
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

        // Join with product_variations table
        $query->join('product_variations', 'products.id', '=', 'product_variations.product_id');

        // Apply category slug filter
        if ($this->categorySlug) {
            $query->whereHas('category', function($q) {
                $q->where('slug', $this->categorySlug);
            });
        }

        // Apply category input filter
        if ($this->category_input) {
            $query->whereIn('category_id', $this->category_input);
        }

        // Apply selected categories filter
        if (!empty($this->selectedCategories)) {
            // dd($this->selectedCategories);
            $query->whereIn('category_id', $this->selectedCategories);
        }

        // Apply brand filter
        if (!empty($this->selectedBrands)) {
            $query->whereIn('brand_id', $this->selectedBrands);
        }

        // Apply variation filter
        if ($this->selectedVariation) {
            $query->where('product_variations.variation_id', $this->selectedVariation);
        }

        // Apply variations filter
        if (!empty($this->selectedVariations)) {
            $query->whereIn('product_variations.variation_id', $this->selectedVariations);
        }

        // Update price filter to use product_variations table
        if ($this->minPrice !== null && $this->maxPrice !== null) {
            $query->where('product_variations.selling_price', '>=', $this->minPrice)
                  ->where('product_variations.selling_price', '<=', $this->maxPrice);
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

        \Log::info('SQL Query: ' . $query->toSql());
        \Log::info('Bindings: ', $query->getBindings());
        
        // Make sure to select products.* to avoid column ambiguity
        $this->products = $query->select('products.*')->distinct()->get();
    }

    public function render()
    {
        // Only load products if filters have changed
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
