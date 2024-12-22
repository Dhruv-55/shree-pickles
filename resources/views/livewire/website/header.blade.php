<div>
     <!-- rts header area start -->
    <!-- rts header area start -->
    <style>
        .rts-megamenu {
    background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    padding: 20px;
}

.megamenu-item-wrapper {
    max-height: 400px;
    overflow-y: auto;
}

.category-container {
    display: flex;
    gap: 0;
    overflow-x: auto;
    scrollbar-width: thin;
    -ms-overflow-style: none;
}

.category-container::-webkit-scrollbar {
    height: 5px;
}

.category-container::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.category-container::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 5px;
}

.category-section {
    min-width: 250px;
    padding: 0 20px;
    border-right: 1px solid #eee;
}

.category-section:last-child {
    border-right: none;
}

.category-section .title {
    color: #dc3545;
    font-size: 16px;
    margin-bottom: 15px;
}

.category-section ul li {
    margin-bottom: 10px;
}

.category-section ul li a {
    color: #333;
    font-size: 14px;
    transition: color 0.2s ease;
}

.category-section ul li a:hover {
    color: #dc3545;
}
    </style>
    <div class="rts-header-one-area-one ">
        <div class="header-top-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bwtween-area-header-top">
                            <div class="discount-area">
                                {{-- <p class="disc">FREE delivery & 40% Discount for next 3 orders! Place your 1st order in.</p> --}}
                                {{-- <div class="countdown">
                                    <div class="countDown">10/05/2025 10:20:00</div>
                                </div> --}}
                            </div>
                            <div class="contact-number-area">
                                <p>Need help? Call Us:
                                    <a href="tel:+447900119463">+44 7900119463</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="header--sticky"> 
            <div class="search-header-area-main">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="logo-search-category-wrapper">
                                <a href="{{ route('website-home') }}" class="logo-area">
                                    <img src="{{asset('logo.jpg')}}" alt="logo-main" class="logo custom-log">
                                </a>
                                <div class="category-search-wrapper">
                                    <div class="category-btn category-hover-header">
                                        <img class="parent" src="{{ env('LOCAL_URL') }}website-assets/images/icons/bar-1.svg" alt="icons">
                                        <span>Categories</span>
                                        <ul class="category-sub-menu" id="category-active-four">
                                         
                                            @foreach($categories as $category)
                                            <li>
                                                <a href="{{ $category->subcategories->count() > 0 ? '#' : route('website-product-view', $category->slug) }}" 
                                                   class="menu-item {{ $category->subcategories->count() > 0 ? 'has-submenu' : '' }}">
                                                    @if($category->icon)
                                                        <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}">
                                                    @endif
                                                    <span>{{ $category->name }}</span>
                                                    @if($category->subcategories->count() > 0)
                                                        <i class="fa-regular fa-plus"></i>
                                                    @endif
                                                </a>
                                                @if($category->subcategories->count() > 0)
                                                    <ul class="submenu mm-collapse">
                                                        @foreach($category->subcategories as $subcategory)
                                                            <li>
                                                                <a class="mobile-menu-link" href="{{ route('website-product-view', $subcategory->slug) }}">
                                                                    {{ $subcategory->name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <form action="index.html#" class="search-header">
                                        <input type="text" placeholder="Search for products, categories or brands" required>
                                        <a href="index.html#" class="rts-btn btn-primary radious-sm with-icon">
                                            <div class="btn-text">
                                                Search
                                            </div>
                                            {{-- <div class="arrow-icon">
                                                <i class="fa-light fa-magnifying-glass"></i>
                                            </div>
                                            <div class="arrow-icon">
                                                <i class="fa-light fa-magnifying-glass"></i>
                                            </div> --}}
                                        </a>
                                    </form>
                                </div>
                                <div class="actions-area">
                                    <div class="search-btn" id="searchs">
    
                                        <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.75 14.7188L11.5625 10.5312C12.4688 9.4375 12.9688 8.03125 12.9688 6.5C12.9688 2.9375 10.0312 0 6.46875 0C2.875 0 0 2.9375 0 6.5C0 10.0938 2.90625 13 6.46875 13C7.96875 13 9.375 12.5 10.5 11.5938L14.6875 15.7812C14.8438 15.9375 15.0312 16 15.25 16C15.4375 16 15.625 15.9375 15.75 15.7812C16.0625 15.5 16.0625 15.0312 15.75 14.7188ZM1.5 6.5C1.5 3.75 3.71875 1.5 6.5 1.5C9.25 1.5 11.5 3.75 11.5 6.5C11.5 9.28125 9.25 11.5 6.5 11.5C3.71875 11.5 1.5 9.28125 1.5 6.5Z" fill="#1F1F25"></path>
                                        </svg>
    
                                    </div>
                                    <div class="menu-btn" id="menu-btn">
    
                                        <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect y="14" width="20" height="2" fill="#1F1F25"></rect>
                                            <rect y="7" width="20" height="2" fill="#1F1F25"></rect>
                                            <rect width="20" height="2" fill="#1F1F25"></rect>
                                        </svg>
    
                                    </div>
                                </div>
                                <div class="accont-wishlist-cart-area-header">
                                    @if(Session::has('user'))
                                    <a href="{{ route('user-dashboard') }}" class="btn-border-only account">
                                        <i class="fa-light fa-user"></i>
                                        <span>Account</span>
                                    </a>
                                    @else
                                    <a href="{{ route('website-auth-login') }}" class="btn-border-only account">
                                        <i class="fa-light fa-user"></i>
                                        <span>Login</span>
                                    </a>
                                    @endif
                                    {{-- <a href="wishlist.html" class="btn-border-only wishlist">
                                        <i class="fa-regular fa-heart"></i>
                                        <span class="text">Wishlist</span>
                                        <span class="number">2</span>
                                    </a> --}}
                                    <div class="btn-border-only cart category-hover-header">
                                        <i class="fa-sharp fa-regular fa-cart-shopping"></i>
                                        <span class="text">My Cart</span>
                                        <span class="number">{{ $cart_count }}</span>
                                        <div class="category-sub-menu card-number-show">
                                            <h5 class="shopping-cart-number">Shopping Cart ({{ $cart_count }})</h5>
                                            
                                            @forelse($cart_items as $item)
                                                <div class="cart-item-1 {{ $loop->first ? 'border-top' : '' }}">
                                                    <div class="img-name">
                                                        <div class="thumbanil">
                                                            <img src="{{ App\Models\Product::getFirstImage($item->product->id) }}" alt="{{ $item->name }}">
                                                        </div>
                                                        <div class="details">
                                                            <a href="{{ route('website-product-detail', $item->product->slug) }}">
                                                                <h5 class="title">{{ $item->product->name }}</h5>
                                                            </a>
                                                            <div class="number">
                                                                {{ $item->qty }} <i class="fa-regular fa-x"></i>
                                                                <span>£{{ number_format($item->product->variationPrice['selling_price'], 2) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="close-c1">
                                                        <i class="fa-regular fa-x" 
                                                           wire:click.prevent="removeFromCart('{{ $item->id }}')"
                                                           wire:loading.class="opacity-50"
                                                           wire:target="removeFromCart"></i>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="cart-item-1 border-top">
                                                    <p class="text-center py-4">Your cart is empty</p>
                                                </div>
                                            @endforelse
    
                                            @if($cart_count > 0)  
                                                <div class="sub-total-cart-balance">
                                                    <div class="bottom-content-deals mt--10">
                                                        <div class="top">
                                                            <span>Sub Total:</span>
                                                            <span class="number-c">£{{ $cart_subtotal }}</span>
                                                        </div>
                                                        @php
                                                            $progress = ($cart_subtotal / 125) * 100;
                                                            $remaining = max(0, 125 - $cart_subtotal);
                                                        @endphp
                                                        <div class="single-progress-area-incard">
                                                            <div class="progress">
                                                                <div class="progress-bar wow fadeInLeft" role="progressbar" 
                                                                    style="width: {{ min(100, $progress) }}%" 
                                                                    aria-valuenow="{{ min(100, $progress) }}" 
                                                                    aria-valuemin="0" 
                                                                    aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- @if($remaining > 0)
                                                            <p>Spend More <span>${{ number_format($remaining, 2) }}</span> to reach <span>Free Shipping</span></p>
                                                        @else
                                                            <p class="text-success">You've qualified for <span>Free Shipping!</span></p>
                                                        @endif --}}
                                                    </div>
                                                    <div class="button-wrapper d-flex align-items-center justify-content-between">
                                                        <a href="{{ route('website-cart') }}" class="rts-btn btn-primary">View Cart</a>
                                                        <a href="{{ route('website-checkout') }}" class="rts-btn btn-primary border-only">CheckOut</a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <a href="{{ route('website-cart') }}" class="over_link"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rts-header-nav-area-one ">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="nav-and-btn-wrapper">
                                <div class="nav-area">
                                    <nav>
                                        <ul class="parent-nav">
                                            <li class="parent"><a href="{{ route('website-home') }}">Home</a></li>
                                            <li class="parent with-megamenu">
                                                <a href="#">Shop</a>
                                                <div class="rts-megamenu">
                                                    <div class="wrapper">
                                                        <div class="megamenu-item-wrapper">
                                                            <div class="category-container">
                                                                @foreach($categories as $category)
                                                                    <div class="category-section">
                                                                        <p class="title text-danger fw-bold mb-3">{{ $category->name }}</p>
                                                                        @if($category->subcategories->count() > 0)
                                                                            <ul class="list-unstyled">
                                                                                @foreach($category->subcategories as $subcategory)
                                                                                    <li class="mb-2">
                                                                                        <a href="{{ route('website-product-view', $subcategory->slug) }}" 
                                                                                           class="text-decoration-none text-dark">
                                                                                            {{ $subcategory->name }}
                                                                                        </a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="parent"><a href="{{ route('website-about') }}">About</a></li>
                                           
                                            
                                            <li class="parent"><a href="{{ route('website-contact') }}">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- button-area -->
                                {{-- <div class="right-btn-area">
                                    <a href="index.html#" class="btn-narrow">Trending Products</a>
                                    <button class="rts-btn btn-primary">
                                        Get 30% Discount Now
                                        <span>Sale</span>
                                    </button>
                                </div> --}}
                                <!-- button-area end -->
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="logo-search-category-wrapper after-md-device-header">
                                <a href="{{ route('website-home') }}" class="logo-area">
                                    <img src="{{ asset('logo.jpg') }}" alt="logo-main" class="logo">
                                </a>
                                <div class="category-search-wrapper">
                                    <div class="category-btn category-hover-header">
                                        <img class="parent" src="assets/images/icons/bar-1.svg" alt="icons">
                                        <span>Categories</span>
                                        <ul class="category-sub-menu">
                                            <li>
                                                <a href="index.html#" class="menu-item">
                                                    <img src="assets/images/icons/01.svg" alt="icons">
                                                    <span>Breakfast & Dairy</span>
                                                    <i class="fa-regular fa-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="index.html#" class="menu-item">
                                                    <img src="assets/images/icons/02.svg" alt="icons">
                                                    <span>Meats & Seafood</span>
                                                    <i class="fa-regular fa-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="index.html#" class="menu-item">
                                                    <img src="assets/images/icons/03.svg" alt="icons">
                                                    <span>Breads & Bakery</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="index.html#" class="menu-item">
                                                    <img src="assets/images/icons/04.svg" alt="icons">
                                                    <span>Chips & Snacks</span>
                                                    <i class="fa-regular fa-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="index.html#" class="menu-item">
                                                    <img src="assets/images/icons/05.svg" alt="icons">
                                                    <span>Medical Healthcare</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="index.html#" class="menu-item">
                                                    <img src="assets/images/icons/06.svg" alt="icons">
                                                    <span>Breads & Bakery</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="index.html#" class="menu-item">
                                                    <img src="assets/images/icons/07.svg" alt="icons">
                                                    <span>Biscuits & Snacks</span>
                                                    <i class="fa-regular fa-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="index.html#" class="menu-item">
                                                    <img src="assets/images/icons/08.svg" alt="icons">
                                                    <span>Frozen Foods</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="index.html#" class="menu-item">
                                                    <img src="assets/images/icons/09.svg" alt="icons">
                                                    <span>Grocery & Staples</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="index.html#" class="menu-item">
                                                    <img src="assets/images/icons/10.svg" alt="icons">
                                                    <span>Other Items</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <form action="index.html#" class="search-header">
                                        <input type="text" placeholder="Search for products, categories or brands" required>
                                        <button class="rts-btn btn-primary radious-sm with-icon">
                                            <span class="btn-text">
                                            Search
                                        </span>
                                            <span class="arrow-icon">
                                            <i class="fa-light fa-magnifying-glass"></i>
                                        </span>
                                            <span class="arrow-icon">
                                            <i class="fa-light fa-magnifying-glass"></i>
                                        </span>
                                        </button>
                                    </form>
                                </div>
                                <div class="main-wrapper-action-2 d-flex">
                                    {{-- <div class="accont-wishlist-cart-area-header">
                                        <a href="account.html" class="btn-border-only account">
                                            <i class="fa-light fa-user"></i>
                                            Account
                                        </a>
                                        <a href="wishlist.html" class="btn-border-only wishlist">
                                            <i class="fa-regular fa-heart"></i>
                                            Wishlist
                                        </a>
                                        <div class="btn-border-only cart category-hover-header">
                                            <i class="fa-sharp fa-regular fa-cart-shopping"></i>
                                            <span class="text">My Cart</span>
                                            <div class="category-sub-menu card-number-show">
                                                <h5 class="shopping-cart-number">Shopping Cart ({{ $cart_count }})</h5>
                                                
                                                @forelse($cart_items as $item)
                                                    <div class="cart-item-1 {{ $loop->first ? 'border-top' : '' }}">
                                                        <div class="img-name">
                                                            <div class="thumbanil">
                                                                <img src="{{ App\Models\Product::getFirstImage($item->product->id) }}" alt="{{ $item->name }}">
                                                            </div>
                                                            <div class="details">
                                                                <a href="{{ route('website-product-detail', $item->product->slug) }}">
                                                                    <h5 class="title">{{ $item->name }}</h5>
                                                                </a>
                                                                <div class="number">
                                                                    {{ $item->qty }} <i class="fa-regular fa-x"></i>
                                                                    <span>${{ number_format($item->price, 2) }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="close-c1">
                                                            <i class="fa-regular fa-x" 
                                                               wire:click.prevent="removeFromCart('{{ $item->id }}')"
                                                               wire:loading.class="opacity-50"
                                                               wire:target="removeFromCart"></i>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="cart-item-1 border-top">
                                                        <p class="text-center py-4">Your cart is empty</p>
                                                    </div>
                                                @endforelse
    
                                                @if($cart_count > 0)
                                                    <div class="sub-total-cart-balance">
                                                        <div class="bottom-content-deals mt--10">
                                                            <div class="top">
                                                                <span>Sub Total:</span>
                                                                <span class="number-c">${{ $cart_subtotal }}</span>
                                                            </div>
                                                            @php
                                                                $progress = ($cart_subtotal / 125) * 100;
                                                                    $remaining = max(0, 125 - $cart_subtotal);
                                                            @endphp
                                                            <div class="single-progress-area-incard">
                                                                <div class="progress">
                                                                    <div class="progress-bar wow fadeInLeft" role="progressbar" 
                                                                        style="width: {{ min(100, $progress) }}%" 
                                                                        aria-valuenow="{{ min(100, $progress) }}" 
                                                                        aria-valuemin="0" 
                                                                        aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if($remaining > 0)
                                                                <p>Spend More <span>${{ number_format($remaining, 2) }}</span> to reach <span>Free Shipping</span></p>
                                                            @else
                                                                <p class="text-success">You've qualified for <span>Free Shipping!</span></p>
                                                            @endif
                                                        </div>
                                                        <div class="button-wrapper d-flex align-items-center justify-content-between">
                                                            <a href="{{ route('website-cart') }}" class="rts-btn btn-primary">View Cart</a>
                                                            <a href="{{ route('website-checkout') }}" class="rts-btn btn-primary border-only">CheckOut</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <a href="{{ route('website-cart') }}" class="over_link"></a>
                                        </div>
                                    </div> --}}
                                    <div class="actions-area">
                                        <div class="search-btn" id="search">
    
                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.75 14.7188L11.5625 10.5312C12.4688 9.4375 12.9688 8.03125 12.9688 6.5C12.9688 2.9375 10.0312 0 6.46875 0C2.875 0 0 2.9375 0 6.5C0 10.0938 2.90625 13 6.46875 13C7.96875 13 9.375 12.5 10.5 11.5938L14.6875 15.7812C14.8438 15.9375 15.0312 16 15.25 16C15.4375 16 15.625 15.9375 15.75 15.7812C16.0625 15.5 16.0625 15.0312 15.75 14.7188ZM1.5 6.5C1.5 3.75 3.71875 1.5 6.5 1.5C9.25 1.5 11.5 3.75 11.5 6.5C11.5 9.28125 9.25 11.5 6.5 11.5C3.71875 11.5 1.5 9.28125 1.5 6.5Z" fill="#1F1F25"></path>
                                            </svg>
    
                                        </div>
                                        <div class="menu-btn">
    
                                            <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect y="14" width="20" height="2" fill="#1F1F25"></rect>
                                                <rect y="7" width="20" height="2" fill="#1F1F25"></rect>
                                                <rect width="20" height="2" fill="#1F1F25"></rect>
                                            </svg>
    
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
    <!-- rts header area end -->

    <!-- rts header area start -->
    <!-- header style two -->
    <div id="side-bar" class="side-bar header-two">
        <button class="close-icon-menu"><i class="far fa-times"></i></button>


        <form action="index.html#" class="search-input-area-menu mt--30">
            <input type="text" placeholder="Search..." required>
            <button><i class="fa-light fa-magnifying-glass"></i></button>
        </form>

        <div class="mobile-menu-nav-area tab-nav-btn mt--20">

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Menu</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Category</button>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    <!-- mobile menu area start -->
                    <div class="mobile-menu-main">
                        <nav class="nav-main mainmenu-nav mt--30">
                            <ul class="mainmenu metismenu" id="mobile-menu-active">
                                {{-- <li class="has-droupdown">
                                    <a href="index.html#" class="main">Home</a>
                                    <ul class="submenu mm-collapse">
                                        <li><a class="mobile-menu-link" href="index.html">Home One</a></li>
                                        <li><a class="mobile-menu-link" href="index-two.html">Home Two</a></li>
                                        <li><a class="mobile-menu-link" href="index-three.html">Home Three</a></li>
                                        <li><a class="mobile-menu-link" href="index-four.html">Home Four</a></li>
                                        <li><a class="mobile-menu-link" href="index-five.html"> Home Five</a></li>
                                    </ul>
                                </li> --}}
                                <li>
                                    <a href="{{ route('website-home')}}" class="main">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('website-product-view')}}" class="main">Shop</a>
                                </li>
                                {{-- <li class="has-droupdown">
                                    <a href="index.html#" class="main">Pages</a>
                                    <ul class="submenu mm-collapse">
                                        <li><a class="mobile-menu-link" href="about.html">About</a></li>
                                        <li><a class="mobile-menu-link" href="faq.html">Faq's</a></li>
                                        <li><a class="mobile-menu-link" href="invoice.html">Invoice</a></li>
                                        <li><a class="mobile-menu-link" href="contact.html">Contact</a></li>
                                        <li><a class="mobile-menu-link" href="register.html">Register</a></li>
                                        <li><a class="mobile-menu-link" href="login.html">Login</a></li>
                                        <li><a class="mobile-menu-link" href="privacy-policy.html">Privacy Policy</a></li>
                                        <li><a class="mobile-menu-link" href="cookies-policy.html">Cookies Policy</a></li>
                                        <li><a class="mobile-menu-link" href="terms-condition.html">Terms Condition</a></li>
                                        <li><a class="mobile-menu-link" href="404.html">Error Page</a></li>
                                    </ul>
                                </li> --}}
                                {{-- <li class="has-droupdown">
                                    <a href="index.html#" class="main">Shop</a>
                                    <ul class="submenu mm-collapse">
                                        <li class="has-droupdown third-lvl">
                                            <a class="main" href="index.html#">Shop Layout</a>
                                            <ul class="submenu-third-lvl mm-collapse">
                                                <li><a href="shop-grid-sidebar.html"></a>Shop Grid Sidebar</li>
                                                <li><a href="shop-list-sidebar.html"></a>Shop List Sidebar</li>
                                                <li><a href="shop-grid-top-filter.html"></a>Shop Grid Top Filter</li>
                                                <li><a href="shop-list-top-filter.html"></a>Shop List Top Filter</li>
                                            </ul>
                                        </li>
                                        <li class="has-droupdown third-lvl">
                                            <a class="main" href="index.html#">Shop Details</a>
                                            <ul class="submenu-third-lvl mm-collapse">
                                                <li><a href="shop-details.html"></a>Shop Details</li>
                                                <li><a href="shop-details-2.html"></a>Shop Details 2</li>
                                                <li><a href="shop-grid-top-filter.html"></a>Shop Grid Top Filter</li>
                                                <li><a href="shop-list-top-filter.html"></a>Shop List Top Filter</li>
                                            </ul>
                                        </li>
                                        <li class="has-droupdown third-lvl">
                                            <a class="main" href="index.html#">Product Feature</a>
                                            <ul class="submenu-third-lvl mm-collapse">
                                                <li><a href="shop-details-variable.html"></a>Shop Details Variable</li>
                                                <li><a href="shop-details-affiliats.html"></a>Shop Details Affiliats</li>
                                                <li><a href="shop-details-group.html"></a>Shop Details Group</li>
                                                <li><a href="shop-compare.html"></a>Shop Compare</li>
                                            </ul>
                                        </li>
                                        <li class="has-droupdown third-lvl">
                                            <a class="main" href="index.html#">Shop Others</a>
                                            <ul class="submenu-third-lvl mm-collapse">
                                                <li><a href="cart.html"></a>Cart</li>
                                                <li><a href="checkout.html"></a>Checkout</li>
                                                <li><a href="trackorder.html"></a>Trackorder</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-droupdown">
                                    <a href="index.html#" class="main">Blog</a>
                                    <ul class="submenu mm-collapse">
                                        <li><a class="mobile-menu-link" href="blog.html">Blog</a></li>
                                        <li><a class="mobile-menu-link" href="blog-list-left-sidebar.html">Blog Left Sidebar</a></li>
                                        <li><a class="mobile-menu-link" href="blog-list-right-sidebar.html">Blog List Right Sidebar</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="contact.html" class="main">Contact Us</a>
                                </li> --}}
                            </ul>
                        </nav>

                    </div>
                    <!-- mobile menu area end -->
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    <div class="category-btn category-hover-header menu-category">
                        <ul class="category-sub-menu" id="category-active-menu">
                            <ul class="category-sub-menu" id="category-active-four">
                                         
                                @foreach($categories as $category)
                                <li>
                                    <a href="{{ $category->subcategories->count() > 0 ? '#' : route('website-product-view', $category->slug) }}" 
                                       class="menu-item {{ $category->subcategories->count() > 0 ? 'has-submenu' : '' }}">
                                        @if($category->icon)
                                            <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}">
                                        @endif
                                        <span>{{ $category->name }}</span>
                                        @if($category->subcategories->count() > 0)
                                            <i class="fa-regular fa-plus"></i>
                                        @endif
                                    </a>
                                    @if($category->subcategories->count() > 0)
                                        <ul class="submenu mm-collapse">
                                            @foreach($category->subcategories as $subcategory)
                                                <li>
                                                    <a class="mobile-menu-link" href="{{ route('website-product-view', $subcategory->slug) }}">
                                                        {{ $subcategory->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <!-- button area wrapper start -->
        <div class="button-area-main-wrapper-menuy-sidebar mt--50">
            <div class="contact-area">
                <div class="phone">
                    <i class="fa-light fa-headset"></i>
                    <a href="index.html#">02345697871</a>
                </div>
                <div class="phone">
                    <i class="fa-light fa-envelope"></i>
                    <a href="index.html#">02345697871</a>
                </div>
            </div>
            <div class="buton-area-bottom">
                <a href="login.html" class="rts-btn btn-primary">Sign In</a>
                <a href="register.html" class="rts-btn btn-primary">Sign Up</a>
            </div>
        </div>
        <!-- button area wrapper end -->

    </div>
    <!-- header style two End -->
    <!-- rts header area end -->
    <!-- rts header area end -->

</div>
