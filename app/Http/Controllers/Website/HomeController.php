<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
    use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Session;
use App\Models\Banner;
class HomeController extends Controller
{
    public function home(Request $request){
        $user_id = Session::get('user')->id ?? null;
        $categories = Category::where('parent_id',null)->get();
        $products = Product::where('status',1)->with('variations')->get();
        // dd($products);
            // Get best selling products by counting their occurrences in orders
        $best_seller = Product::select('products.*')
            ->selectRaw('(SELECT COUNT(*) FROM order_items WHERE order_items.product_id = products.id) as order_count')
            ->where('status', 1)
            ->orderBy('order_count', 'desc')
            ->with('variations')
            ->limit(3)
            ->get();
        
        $latest_products = Product::where('status',1)->orderBy('created_at','desc')->limit(4)->with('variations')->get();
        $trending_products = Product::where('status',1)->where('trending',1)->limit(4)->with('variations')->get();
        $new_arrivals = Product::where('status',1)->orderBy('created_at','desc')->limit(4)->with('variations')->get();
        $sliders = Banner::where('status',1)->where('type',Banner::SLIDER)->orderby('position','asc')->get();
        return view('website.home',[
            'categories' => $categories,
            'products' => $products,
            'latest_products' => $latest_products,
            'trending_products' => $trending_products,
            'best_seller' => $best_seller,
            'new_arrivals' => $new_arrivals,
            'sliders' => $sliders
        ]);
    }
}

