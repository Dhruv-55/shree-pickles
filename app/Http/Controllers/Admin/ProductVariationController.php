<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariation;
class ProductVariationController extends Controller
{
    public function index($id){
        $product = Product::find($id);
        $variations = ProductVariation::where('product_id',$id)->get();
        return view('admin.product.variation.index',compact('product','variations'));
    }

    public function create($id,Request $request){
        $product = Product::find($id);
        if($request->isMethod('post')){
            $request->validate([
                'variation_id' => 'required',
                'original_price' => 'required',
                'selling_price' => 'required',
                'quantity' => 'required',
            ]);

            if(ProductVariation::where('product_id',$id)->where('variation_id',$request->variation_id)->exists()){
                return redirect()->route('admin-product-variation-view',['id' => $id])->with('error','Variation Already Exists');
            }
            $variation = new ProductVariation();
            $variation->product_id = $id;
            $variation->variation_id = $request->variation_id;
            $variation->original_price = $request->original_price;
            $variation->selling_price = $request->selling_price;
            $variation->quantity = $request->quantity;
            $variation->save();
            return redirect()->route('admin-product-variation-view',['id' => $id])->with('success','Variation Created Successfully');
        }
        return view('admin.product.variation.create',compact('product'));
    }

    public function update($id,Request $request){
        $variation = ProductVariation::find($id);
        $product = Product::find($variation->product_id);
        if($request->isMethod('post')){
            $request->validate([
                'original_price' => 'required',
                'selling_price' => 'required',
                'quantity' => 'required',
            ]);
            $variation->original_price = $request->original_price;
            $variation->selling_price = $request->selling_price;
            $variation->quantity = $request->quantity;
            $variation->save();
            return redirect()->route('admin-product-variation-view',['id' => $variation->product_id])->with('success','Variation Updated Successfully');
        }
        return view('admin.product.variation.update',compact('variation','product'));
    }

    public function delete($id){
        $variation = ProductVariation::find($id);
        $variation->delete();
        return redirect()->route('admin-product-variation-view',['id' => $variation->product_id])->with('success','Variation Deleted Successfully');
    }
}
