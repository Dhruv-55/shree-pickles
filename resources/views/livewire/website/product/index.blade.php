<div>
      <!-- rts navigation bar area start -->
      <div class="rts-navigation-area-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="navigator-breadcrumb-wrapper">
                        <a href="{{ route('website-home') }}">Home</a>
                        <i class="fa-regular fa-chevron-right"></i>
                        <a class="current" href="{{ route('website-product-view') }}">Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts navigation bar area end -->
    <div class="section-seperator">
        <div class="container">
            <hr class="section-seperator">
        </div>
    </div>

    <!-- shop[ grid sidebar wrapper -->
    <div class="shop-grid-sidebar-area rts-section-gap">
        <div class="container">
            <div class="row g-0">
                <div class="col-xl-3 col-lg-12 pr--70 pr_lg--10 pr_sm--10 pr_md--5 rts-sticky-column-item">
                    <div class="sidebar-filter-main theiaStickySidebar">
                        <div class="single-filter-box">
                            <h5 class="title"> Price Filter</h5>
                            <div class="filterbox-body">
                                <div class="half-input-wrapper">
                                    <div class="single">
                                        <label for="min">Min price</label>
                                        <input id="min" type="number" wire:model="minPrice" min="0">
                                    </div>
                                    <div class="single">
                                        <label for="max">Max price</label>
                                        <input id="max" type="number" wire:model="maxPrice" min="0">
                                    </div>
                                </div>
                                <input type="range" class="range" 
                                       wire:model.live="priceRange"
                                       min="{{ $minAvailablePrice }}" 
                                       max="{{ $maxAvailablePrice }}">
                                <div class="filter-value-min-max">
                                    <span>Price: ${{ $minPrice }} — ${{ $maxPrice }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="single-filter-box">
                            <h5 class="title">Product Categories</h5>
                            <div class="filterbox-body">
                                <div class="category-wrapper">
                                    @foreach($categories as $category)
                                        <!-- single category -->
                                        <div class="single-category">
                                            <input id="cat{{ $category->id }}" 
                                                   type="checkbox"
                                                   wire:model="selectedCategories" 
                                                   value="{{ $category->id }}">
                                            <label for="cat{{ $category->id }}">
                                                {{ $category->name }}
                                            </label>
                                        </div>
                                        <!-- single category end -->
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- <div class="single-filter-box">
                            <h5 class="title">Product Status</h5>
                            <div class="filterbox-body">
                                <div class="category-wrapper">
                                    <!-- single category -->
                                    <div class="single-category">
                                        <input id="cat11" type="checkbox">
                                        <label for="cat11">In Stock

                                        </label>
                                    </div>
                                    <!-- single category end -->
                                    <!-- single category -->
                                    <div class="single-category">
                                        <input id="cat12" type="checkbox">
                                        <label for="cat12">On Sale

                                        </label>
                                    </div>
                                    <!-- single category end -->
                                </div>
                            </div>
                        </div> --}}
                        <div class="single-filter-box">
                            <h5 class="title">Select Brands</h5>
                            <div class="filterbox-body">
                                <div class="category-wrapper">
                                    @foreach($brands as $brand)
                                        <div class="single-category">
                                            <input id="brand{{ $brand->id }}" 
                                                   type="checkbox"
                                                   wire:model="selectedBrands" 
                                                   value="{{ $brand->id }}">
                                            <label for="brand{{ $brand->id }}">
                                                {{ $brand->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="single-filter-box">
                            <h5 class="title">Select Variations</h5>
                            <div class="filterbox-body">
                                <div class="category-wrapper">
                                    @foreach($variations as $variation)
                                        <div class="single-category">
                                            <input id="var{{ $loop->index }}" 
                                                   type="checkbox"
                                                   wire:model="selectedVariations" 
                                                   value="{{ $variation }}">
                                            <label for="var{{ $loop->index }}">
                                                {{ $variation }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-12">
                    <div class="filter-select-area">
                        <div class="top-filter">
                            <span></span>
                            <div class="right-end">
                                {{-- <span>Sort: Short By Latest</span> --}}
                                <div class="button-tab-area">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link single-button active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.5" y="0.5" width="6" height="6" rx="1.5" stroke="#2C3B28" />
                                                    <rect x="0.5" y="9.5" width="6" height="6" rx="1.5" stroke="#2C3B28" />
                                                    <rect x="9.5" y="0.5" width="6" height="6" rx="1.5" stroke="#2C3B28" />
                                                    <rect x="9.5" y="9.5" width="6" height="6" rx="1.5" stroke="#2C3B28" />
                                                </svg>
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link single-button" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.5" y="0.5" width="6" height="6" rx="1.5" stroke="#2C3C28" />
                                                    <rect x="0.5" y="9.5" width="6" height="6" rx="1.5" stroke="#2C3C28" />
                                                    <rect x="9" y="3" width="7" height="1" fill="#2C3C28" />
                                                    <rect x="9" y="12" width="7" height="1" fill="#2C3C28" />
                                                </svg>
                                            </button>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <div class="nice-select-area-wrapper-and-button">
                            <div class="nice-select-wrapper-1">
                                <div class="single-select">
                                    <select wire:model="selectedCategory">
                                        <option value="">All Categories</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="single-select">
                                    <select wire:model="selectedBrand">
                                        <option value="">All Brands</option>
                                        @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                             
                                <div class="single-select">
                                    <select wire:model="selectedVariation">
                                        <option value="">All Weight</option>
                                        @foreach (App\Models\ProductVariation::variations() as $key => $variation)
                                        <option value="{{ $key }}">{{ $variation }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="button-area">
                                <button class="rts-btn" wire:click="applyFilter">Filter</button>
                                <button class="rts-btn" wire:click="resetFilter">Reset Filter</button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <div class="product-area-wrapper-shopgrid-list mt--20 tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div class="row g-4">
                                @foreach ($products as $product)
                                <div class="col-lg-20 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="{{ route('website-product-detail', $product->slug) }}" class="thumbnail-preview">
                                                <div class="badge">
                                                    <span>{{ $product->discount_percentage }}% <br> 
                                                        Off
                                                    </span>
                                                    <i class="fa-solid fa-bookmark"></i>
                                                </div>
                                                <img src="{{ $product->getFirstImage($product->id) }}" alt="grocery">
                                            </a>
                                            {{-- <div class="action-share-optimon">
                                                <div class="single-action openuptip message-show-action" data-flow="up" title="Add To Wishlist">
                                                    <i class="fa-light fa-heart"></i>
                                                </div>
                                                <div class="single-action openuptip" data-flow="up" title="Compare" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <i class="fa-solid fa-arrows-retweet"></i>
                                                </div>
                                                <div class="single-action openuptip cta-quickview product-details-popup-btn" data-flow="up" title="Quick View">
                                                    <i class="fa-regular fa-eye"></i>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <!-- iamge and sction area start -->

                                        <div class="body-content">

                                            <a href="{{ route('website-product-detail', $product->slug) }}">
                                                <h4 class="title">{{ $product->name }}</h4>
                                            </a>
                                            
                                            <span class="availability">{{ $product->variation }}</span>
                                            <div class="price-area">
                                                <span class="current">£{{ $product->variationPrice['selling_price'] }}</span>
                                                <div class="previous">£{{ $product->variationPrice['original_price'] }}</div>
                                            </div>
                                            <div class="cart-counter-action">
                                                @if(isset($quantity[$product->id]) && $quantity[$product->id] > 0)
                                                    <div class="quantity-edit">
                                                        <input type="text" class="input" value="{{ $quantity[$product->id] }}" readonly>
                                                        <div class="button-wrapper-action">
                                                            <button type="button" class="button" wire:click.prevent="decrementQuantity({{ $product->id }})">
                                                                <i class="fa-regular fa-chevron-down"></i>
                                                            </button>
                                                            <button type="button" class="button plus" wire:click.prevent="incrementQuantity({{ $product->id }})">
                                                                <i class="fa-regular fa-chevron-up"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @else
                                                    <button type="button" class="rts-btn btn-primary radious-sm with-icon" 
                                                            wire:click.prevent="addToCart({{ $product->id }})">
                                                        <div class="btn-text">
                                                            Add
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="product-area-wrapper-shopgrid-list with-list mt--20 tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-shopping-card-one discount-offer">
                                        <a href="shop-details.html" class="thumbnail-preview">
                                            <div class="badge">
                                                <span>25% <br> 
                                                    Off
                                                </span>
                                                <i class="fa-solid fa-bookmark"></i>
                                            </div>
                                            <img src="assets/images/grocery/03.jpg" alt="grocery">
                                        </a>
                                        <div class="body-content">
                                            <div class="title-area-left">
                                                <a href="shop-details.html">
                                                    <h4 class="title">Nestle Cerelac Mixed Fruits &amp;
                                                        Wheat with Milk</h4>
                                                </a>
                                                <span class="availability">500g Pack</span>
                                                <div class="price-area">
                                                    <span class="current">$36.00</span>
                                                    <div class="previous">$36.00</div>
                                                </div>
                                                <div class="cart-counter-action">
                                                    <div class="quantity-edit">
                                                        <input type="text" class="input" value="1">
                                                        <div class="button-wrapper-action">
                                                            <button class="button"><i class="fa-regular fa-chevron-down"></i></button>
                                                            <button class="button plus">+<i class="fa-regular fa-chevron-up"></i></button>
                                                        </div>
                                                    </div>
                                                    <a href="shop-grid-sidebar.html#" class="rts-btn btn-primary radious-sm with-icon">
                                                        <div class="btn-text">
                                                            Add To Cart
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="natural-value">
                                                <h6 class="title">
                                                    Nutritional Values
                                                </h6>
                                                <div class="single">
                                                    <span>Energy(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Protein(g):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>magnetiam(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Calory(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Vitamine(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-shopping-card-one discount-offer">
                                        <a href="shop-details.html" class="thumbnail-preview">
                                            <div class="badge">
                                                <span>25% <br> 
                                                    Off
                                                </span>
                                                <i class="fa-solid fa-bookmark"></i>
                                            </div>
                                            <img src="assets/images/grocery/04.jpg" alt="grocery">
                                        </a>
                                        <div class="body-content">
                                            <div class="title-area-left">
                                                <a href="shop-details.html">
                                                    <h4 class="title">Varts Cerelac Mixed Fruits &amp;
                                                        Wheat with Milk</h4>
                                                </a>
                                                <span class="availability">500g Pack</span>
                                                <div class="price-area">
                                                    <span class="current">$36.00</span>
                                                    <div class="previous">$36.00</div>
                                                </div>
                                                <div class="cart-counter-action">
                                                    <div class="quantity-edit">
                                                        <input type="text" class="input" value="1">
                                                        <div class="button-wrapper-action">
                                                            <button class="button"><i class="fa-regular fa-chevron-down"></i></button>
                                                            <button class="button plus">+<i class="fa-regular fa-chevron-up"></i></button>
                                                        </div>
                                                    </div>
                                                    <a href="shop-grid-sidebar.html#" class="rts-btn btn-primary radious-sm with-icon">
                                                        <div class="btn-text">
                                                            Add To Cart
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="natural-value">
                                                <h6 class="title">
                                                    Nutritional Values
                                                </h6>
                                                <div class="single">
                                                    <span>Energy(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Protein(g):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>magnetiam(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Calory(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Vitamine(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-shopping-card-one discount-offer">
                                        <a href="shop-details.html" class="thumbnail-preview">
                                            <div class="badge">
                                                <span>25% <br> 
                                                    Off
                                                </span>
                                                <i class="fa-solid fa-bookmark"></i>
                                            </div>
                                            <img src="assets/images/grocery/05.jpg" alt="grocery">
                                        </a>
                                        <div class="body-content">
                                            <div class="title-area-left">
                                                <a href="shop-details.html">
                                                    <h4 class="title">Nestle Cerelac Mixed Fruits &amp;
                                                        Wheat with Milk</h4>
                                                </a>
                                                <span class="availability">500g Pack</span>
                                                <div class="price-area">
                                                    <span class="current">$36.00</span>
                                                    <div class="previous">$36.00</div>
                                                </div>
                                                <div class="cart-counter-action">
                                                    <div class="quantity-edit">
                                                        <input type="text" class="input" value="1">
                                                        <div class="button-wrapper-action">
                                                            <button class="button"><i class="fa-regular fa-chevron-down"></i></button>
                                                            <button class="button plus">+<i class="fa-regular fa-chevron-up"></i></button>
                                                        </div>
                                                    </div>
                                                    <a href="shop-grid-sidebar.html#" class="rts-btn btn-primary radious-sm with-icon">
                                                        <div class="btn-text">
                                                            Add To Cart
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="natural-value">
                                                <h6 class="title">
                                                    Nutritional Values
                                                </h6>
                                                <div class="single">
                                                    <span>Energy(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Protein(g):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>magnetiam(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Calory(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Vitamine(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-shopping-card-one discount-offer">
                                        <a href="shop-details.html" class="thumbnail-preview">
                                            <div class="badge">
                                                <span>25% <br> 
                                                    Off
                                                </span>
                                                <i class="fa-solid fa-bookmark"></i>
                                            </div>
                                            <img src="assets/images/grocery/06.jpg" alt="grocery">
                                        </a>
                                        <div class="body-content">
                                            <div class="title-area-left">
                                                <a href="shop-details.html">
                                                    <h4 class="title">Nestle Cerelac Mixed Fruits &amp;
                                                        Wheat with Milk</h4>
                                                </a>
                                                <span class="availability">500g Pack</span>
                                                <div class="price-area">
                                                    <span class="current">$36.00</span>
                                                    <div class="previous">$36.00</div>
                                                </div>
                                                <div class="cart-counter-action">
                                                    <div class="quantity-edit">
                                                        <input type="text" class="input" value="1">
                                                        <div class="button-wrapper-action">
                                                            <button class="button"><i class="fa-regular fa-chevron-down"></i></button>
                                                            <button class="button plus">+<i class="fa-regular fa-chevron-up"></i></button>
                                                        </div>
                                                    </div>
                                                    <a href="shop-grid-sidebar.html#" class="rts-btn btn-primary radious-sm with-icon">
                                                        <div class="btn-text">
                                                            Add To Cart
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="natural-value">
                                                <h6 class="title">
                                                    Nutritional Values
                                                </h6>
                                                <div class="single">
                                                    <span>Energy(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Protein(g):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>magnetiam(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Calory(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Vitamine(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-shopping-card-one discount-offer">
                                        <a href="shop-details.html" class="thumbnail-preview">
                                            <div class="badge">
                                                <span>25% <br> 
                                                    Off
                                                </span>
                                                <i class="fa-solid fa-bookmark"></i>
                                            </div>
                                            <img src="assets/images/grocery/01.jpg" alt="grocery">
                                        </a>
                                        <div class="body-content">
                                            <div class="title-area-left">
                                                <a href="shop-details.html">
                                                    <h4 class="title">Nestle Cerelac Mixed Fruits &amp;
                                                        Wheat with Milk</h4>
                                                </a>
                                                <span class="availability">500g Pack</span>
                                                <div class="price-area">
                                                    <span class="current">$36.00</span>
                                                    <div class="previous">$36.00</div>
                                                </div>
                                                <div class="cart-counter-action">
                                                    <div class="quantity-edit">
                                                        <input type="text" class="input" value="1">
                                                        <div class="button-wrapper-action">
                                                            <button class="button"><i class="fa-regular fa-chevron-down"></i></button>
                                                            <button class="button plus">+<i class="fa-regular fa-chevron-up"></i></button>
                                                        </div>
                                                    </div>
                                                    <a href="shop-grid-sidebar.html#" class="rts-btn btn-primary radious-sm with-icon">
                                                        <div class="btn-text">
                                                            Add To Cart
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="natural-value">
                                                <h6 class="title">
                                                    Nutritional Values
                                                </h6>
                                                <div class="single">
                                                    <span>Energy(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Protein(g):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>magnetiam(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Calory(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Vitamine(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-shopping-card-one discount-offer">
                                        <a href="shop-details.html" class="thumbnail-preview">
                                            <div class="badge">
                                                <span>25% <br> 
                                                    Off
                                                </span>
                                                <i class="fa-solid fa-bookmark"></i>
                                            </div>
                                            <img src="assets/images/grocery/03.jpg" alt="grocery">
                                        </a>
                                        <div class="body-content">
                                            <div class="title-area-left">
                                                <a href="shop-details.html">
                                                    <h4 class="title">Nestle Cerelac Mixed Fruits &amp;
                                                        Wheat with Milk</h4>
                                                </a>
                                                <span class="availability">500g Pack</span>
                                                <div class="price-area">
                                                    <span class="current">$36.00</span>
                                                    <div class="previous">$36.00</div>
                                                </div>
                                                <div class="cart-counter-action">
                                                    <div class="quantity-edit">
                                                        <input type="text" class="input" value="1">
                                                        <div class="button-wrapper-action">
                                                            <button class="button"><i class="fa-regular fa-chevron-down"></i></button>
                                                            <button class="button plus">+<i class="fa-regular fa-chevron-up"></i></button>
                                                        </div>
                                                    </div>
                                                    <a href="shop-grid-sidebar.html#" class="rts-btn btn-primary radious-sm with-icon">
                                                        <div class="btn-text">
                                                            Add To Cart
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="natural-value">
                                                <h6 class="title">
                                                    Nutritional Values
                                                </h6>
                                                <div class="single">
                                                    <span>Energy(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Protein(g):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>magnetiam(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Calory(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Vitamine(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-shopping-card-one discount-offer">
                                        <a href="shop-details.html" class="thumbnail-preview">
                                            <div class="badge">
                                                <span>25% <br> 
                                                    Off
                                                </span>
                                                <i class="fa-solid fa-bookmark"></i>
                                            </div>
                                            <img src="assets/images/grocery/04.jpg" alt="grocery">
                                        </a>
                                        <div class="body-content">
                                            <div class="title-area-left">
                                                <a href="shop-details.html">
                                                    <h4 class="title">Nestle Cerelac Mixed Fruits &amp;
                                                        Wheat with Milk</h4>
                                                </a>
                                                <span class="availability">500g Pack</span>
                                                <div class="price-area">
                                                    <span class="current">$36.00</span>
                                                    <div class="previous">$36.00</div>
                                                </div>
                                                <div class="cart-counter-action">
                                                    <div class="quantity-edit">
                                                        <input type="text" class="input" value="1">
                                                        <div class="button-wrapper-action">
                                                            <button class="button"><i class="fa-regular fa-chevron-down"></i></button>
                                                            <button class="button plus">+<i class="fa-regular fa-chevron-up"></i></button>
                                                        </div>
                                                    </div>
                                                    <a href="shop-grid-sidebar.html#" class="rts-btn btn-primary radious-sm with-icon">
                                                        <div class="btn-text">
                                                            Add To Cart
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="natural-value">
                                                <h6 class="title">
                                                    Nutritional Values
                                                </h6>
                                                <div class="single">
                                                    <span>Energy(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Protein(g):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>magnetiam(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Calory(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Vitamine(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-shopping-card-one discount-offer">
                                        <a href="shop-details.html" class="thumbnail-preview">
                                            <div class="badge">
                                                <span>25% <br> 
                                                    Off
                                                </span>
                                                <i class="fa-solid fa-bookmark"></i>
                                            </div>
                                            <img src="assets/images/grocery/05.jpg" alt="grocery">
                                        </a>
                                        <div class="body-content">
                                            <div class="title-area-left">
                                                <a href="shop-details.html">
                                                    <h4 class="title">Nestle Cerelac Mixed Fruits &amp;
                                                        Wheat with Milk</h4>
                                                </a>
                                                <span class="availability">500g Pack</span>
                                                <div class="price-area">
                                                    <span class="current">$36.00</span>
                                                    <div class="previous">$36.00</div>
                                                </div>
                                                <div class="cart-counter-action">
                                                    <div class="quantity-edit">
                                                        <input type="text" class="input" value="1">
                                                        <div class="button-wrapper-action">
                                                            <button class="button"><i class="fa-regular fa-chevron-down"></i></button>
                                                            <button class="button plus">+<i class="fa-regular fa-chevron-up"></i></button>
                                                        </div>
                                                    </div>
                                                    <a href="shop-grid-sidebar.html#" class="rts-btn btn-primary radious-sm with-icon">
                                                        <div class="btn-text">
                                                            Add To Cart
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="natural-value">
                                                <h6 class="title">
                                                    Nutritional Values
                                                </h6>
                                                <div class="single">
                                                    <span>Energy(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Protein(g):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>magnetiam(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Calory(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Vitamine(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-shopping-card-one discount-offer">
                                        <a href="shop-details.html" class="thumbnail-preview">
                                            <div class="badge">
                                                <span>25% <br> 
                                                    Off
                                                </span>
                                                <i class="fa-solid fa-bookmark"></i>
                                            </div>
                                            <img src="assets/images/grocery/06.jpg" alt="grocery">
                                        </a>
                                        <div class="body-content">
                                            <div class="title-area-left">
                                                <a href="shop-details.html">
                                                    <h4 class="title">Nestle Cerelac Mixed Fruits &amp;
                                                        Wheat with Milk</h4>
                                                </a>
                                                <span class="availability">500g Pack</span>
                                                <div class="price-area">
                                                    <span class="current">$36.00</span>
                                                    <div class="previous">$36.00</div>
                                                </div>
                                                <div class="cart-counter-action">
                                                    <div class="quantity-edit">
                                                        <input type="text" class="input" value="1">
                                                        <div class="button-wrapper-action">
                                                            <button class="button"><i class="fa-regular fa-chevron-down"></i></button>
                                                            <button class="button plus">+<i class="fa-regular fa-chevron-up"></i></button>
                                                        </div>
                                                    </div>
                                                    <a href="shop-grid-sidebar.html#" class="rts-btn btn-primary radious-sm with-icon">
                                                        <div class="btn-text">
                                                            Add To Cart
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="natural-value">
                                                <h6 class="title">
                                                    Nutritional Values
                                                </h6>
                                                <div class="single">
                                                    <span>Energy(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Protein(g):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>magnetiam(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Calory(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Vitamine(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-shopping-card-one discount-offer">
                                        <a href="shop-details.html" class="thumbnail-preview">
                                            <div class="badge">
                                                <span>25% <br> 
                                                    Off
                                                </span>
                                                <i class="fa-solid fa-bookmark"></i>
                                            </div>
                                            <img src="assets/images/grocery/01.jpg" alt="grocery">
                                        </a>
                                        <div class="body-content">
                                            <div class="title-area-left">
                                                <a href="shop-details.html">
                                                    <h4 class="title">Nestle Cerelac Mixed Fruits &amp;
                                                        Wheat with Milk</h4>
                                                </a>
                                                <span class="availability">500g Pack</span>
                                                <div class="price-area">
                                                    <span class="current">$36.00</span>
                                                    <div class="previous">$36.00</div>
                                                </div>
                                                <div class="cart-counter-action">
                                                    <div class="quantity-edit">
                                                        <input type="text" class="input" value="1">
                                                        <div class="button-wrapper-action">
                                                            <button class="button"><i class="fa-regular fa-chevron-down"></i></button>
                                                            <button class="button plus">+<i class="fa-regular fa-chevron-up"></i></button>
                                                        </div>
                                                    </div>
                                                    <a href="shop-grid-sidebar.html#" class="rts-btn btn-primary radious-sm with-icon">
                                                        <div class="btn-text">
                                                            Add To Cart
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa-regular fa-cart-shopping"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="natural-value">
                                                <h6 class="title">
                                                    Nutritional Values
                                                </h6>
                                                <div class="single">
                                                    <span>Energy(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Protein(g):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>magnetiam(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Calory(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                                <div class="single">
                                                    <span>Vitamine(kcal):</span>
                                                    <span>211</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop[ grid sidebar wrapper end -->


</div>