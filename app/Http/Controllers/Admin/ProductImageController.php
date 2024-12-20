<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductImageController extends Controller
{
    public function index(Request $request){

        $images = ProductImage::select('product_id', DB::raw('MIN(image) as image'))
                ->groupBy('product_id')
                ->paginate(30);

        return view('admin.product.image.index',[
            'images' => $images   
        ]);   
    }

    public function create(Request $request){

        if($request->isMethod('post')){
        //    $this->validate($request,[
        //      'product_id' => 'required',
        //      'images.*' => 'required'
        //    ]);

           DB::transaction(function () use ($request) {
            foreach ($request->images as $image) {
                $product_image = null;
        
                if ($image->isValid()) {
                    $disk = Storage::disk('spaces');
                    $product_image = (string) Str::random(4) . "." . $image->getClientOriginalExtension();
                    $disk->put(env('PRODUCT_IMAGE_PATH') . $product_image, file_get_contents($image->path()));
                }
        
                ProductImage::create([
                    'product_id' => $request->product_id,
                    'image' => $product_image
                ]);
            }
        });

        return redirect()->route('admin-product-image-view')->with(['success' => 'Images Uploaded Successfully']);

        }

        return view('admin.product.image.create');
    }

    public function update(Request $request){

        $image = ProductImage::select('product_id', 'image')
        ->orderBy('product_id')
        ->get()
        ->groupBy('product_id');
    dd ($image);
    
        return view('admin.product.image.update',[
            'image' => $image
        ]);
    }
}
