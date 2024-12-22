<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetail;
class ProductDetailController extends Controller
{
    public function manage(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $productDetail = ProductDetail::where('product_id', $id)->first();

        if ($request->isMethod('post')) {
            $data = $request->all();
            
            if ($productDetail) {
                // Update existing record
                $productDetail->detail = $data['detail'];
                $productDetail->information = $data['information'];
            } else {
                // Create new record
                $productDetail = new ProductDetail();
                $productDetail->product_id = $id;
                $productDetail->detail = $data['detail'];
                $productDetail->information = $data['information'];
            }
            
            $productDetail->save();
            
            return redirect()->back()->with('success', 
                $productDetail->wasRecentlyCreated 
                    ? 'Product Detail Created Successfully' 
                    : 'Product Detail Updated Successfully'
            );
        }

        return view('admin.product.detail.manage', compact('product', 'productDetail'));
    }
}
