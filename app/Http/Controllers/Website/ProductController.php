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
        return view('website.product.index',[
            'products' => Product::with(['category'])->get(),
            'categories' => Category::withCount(['products'])->active()->get(),
            'brands' => Brand::where('status',1)->get()
        ]);
    }

    public function detail(Request $request){

        if(! $product = Product::with(['category'])->where('slug',$request->slug)->first())
            return redirect()->back()->with(['error' => 'Product not found']);

         $related_products = Product::with(['category'])->whereHas('category',function($q)use($product){
            $q->where('slug',$product->category->slug);
         }) /*->whereNot('id',$product->id)*/ ->get();   

        return view('website.product.detail',[
            'product' => $product,
            'related_products' => $related_products
        ]);
    }
}
