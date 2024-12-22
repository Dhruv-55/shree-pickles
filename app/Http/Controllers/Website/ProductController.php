<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Brand;
class ProductController extends Controller
{
    public function index(Request $request){
        // dd($request->category);
        $categorySlug = $request->category;
        if($categorySlug){  
            $products = Product::with(['category'])->whereHas('category',function($q)use($categorySlug){
                $q->where('slug',$categorySlug);
            })->get();
        }else{
            $products = Product::with(['category'])->get();
        }
        // dd($categorySlug);
        return view('website.product.index',[
            'products' => $products,
            'categories' => Category::withCount(['products'])->where('status',1)->whereNotNull('parent_id')->active()->get(),
            'brands' => Brand::where('status',1)->get(),
            'categorySlug' => $categorySlug
        ]);
    }

    public function detail(Request $request){

        if(! $product = Product::with(['category'])->where('slug',$request->slug)->first())
            return redirect()->back()->with(['error' => 'Product not found']);

        $related_products = collect();

        if ($product->category) {
            $related_products = Product::with(['category'])
                ->whereHas('category', function($q) use($product) {
                    $q->where('slug', $product->category->slug);
                })
                ->where('id', '!=', $product->id)
                ->get();
        }
// dd($related_products);
        return view('website.product.detail',[
            'product' => $product,
            'related_products' => $related_products
        ]);
    }
}
