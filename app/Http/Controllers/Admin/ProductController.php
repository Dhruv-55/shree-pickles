<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class ProductController extends Controller
{
   public function index(Request $request){
    return view('admin.product.index',[
        'products' => Product::paginate(20)
    ]);
   }

   public function create(Request $request)
   {
       if ($request->isMethod('post')) {
           $this->validate($request, [
               'name' => 'required',
               'slug' => 'required',
               'category_id' => 'required',
               'parent_category_id' => 'required',
               'short_description' => 'required',
               'description' => 'required',
               'images' => 'required|array'  // Ensure it's an array
           ]);
   
           DB::transaction(function() use($request) {
               // Create the product
               $product = Product::create([
                   'name' => $request->name,
                   'slug' => Str::slug($request->slug),
                   'parent_category_id' => $request->parent_category_id,
                   'category_id' => $request->category_id,
                   'brand_id' => $request->brand_id,
                   'short_description' => $request->short_description,
                   'description' => $request->description,
                   'trending' => $request->trending ?? 2,
               ]);
   
               $imagePaths = []; // Initialize an array to store image paths
   
               // Check if images are uploaded and process them
               if ($request->has('images')) {
                   foreach ($request->images as $image) {
                       $product_image = null;
   
                       if ($image->isValid()) {
                           $disk = Storage::disk('spaces');
                           // Generate a unique name for the image
                           $product_image = Str::random(4) . '.' . $image->getClientOriginalExtension();
                           // Store the image file on the 'spaces' disk
                           $disk->put(env('PRODUCT_IMAGE_PATH') . $product_image, file_get_contents($image->path()));
   
                           // Store the image path (relative or full URL)
                           $imagePaths[] = $product_image;
                       }
                   }
               }
   
               // Update the product with the image paths
               $product->images = $imagePaths; // Store as JSON or as a serialized array
               $product->save();
           });
   
           return redirect()->route('admin-product-view')->with(['success' => 'Product Created Successfully']);
       }
   
       return view('admin.product.create');
   }
   
   public function update(Request $request)
   {
       // Fetch the product by ID, return error if not found
       if (! $product = Product::where('id', $request->id)->first()) {
           return redirect()->back()->with(['error' => 'Product Not Found']);
       }
   
       if ($request->isMethod('post')) {
           // Validate input fields
           $this->validate($request, [
               'name' => 'required',
               'slug' => 'required',
               'category_id' => 'required',
               'parent_category_id' => 'required',
               'short_description' => 'required',
               'description' => 'required',
              ]);
   
           // Update basic product details
           $product->name = $request->name;
           $product->slug = $request->slug;
           $product->category_id = $request->category_id;
           $product->parent_category_id = $request->parent_category_id;
           $product->qty_type = $request->qty_type;
           $product->brand_id = $request->brand_id;
           $product->short_description = $request->short_description;
           $product->description = $request->description;
           $product->trending = $request->trending ?? 2;
           $product->status = $request->status;
   
           // Handle image uploads (if any)
           if ($request->has('images')) {
               $imagePaths = []; // Initialize an array to store new image paths
   
               // If there are old images, add them to the $imagePaths array
               if ($product->images) {
                   $imagePaths = $product->images; // Retain the old images
               }
   
               // Process the new images
               foreach ($request->images as $image) {
                   $product_image = null;
   
                   if ($image->isValid()) {
                       $disk = Storage::disk('spaces');
                       // Generate a unique name for the image
                       $product_image = Str::random(4) . '.' . $image->getClientOriginalExtension();
                       // Store the image file on the 'spaces' disk
                       $disk->put(env('PRODUCT_IMAGE_PATH') . $product_image, file_get_contents($image->path()));
   
                       // Add the image path to the array
                       $imagePaths[] = $product_image; // Append new image
                   }
               }
   
               // Update the product's images field only if new images were uploaded
               if (count($imagePaths) > 0) {
                   $product->images = $imagePaths; // Store the images (old + new) as an array
               }
           }
   
           // Save the updated product
           $product->save();
   
           return redirect()->route('admin-product-view')->with(['success' => 'Product Updated Successfully']);
       }
   
       // Show the update form with the current product details
       return view('admin.product.update', [
           'product' => $product
       ]);
   }
   
   
   public function deleteImage(Request $request)
{
    $product = Product::find($request->product_id);
    
    // Ensure the product exists
    if (!$product) {
        return response()->json(['success' => false, 'message' => 'Product not found.']);
    }

    // Decode the images from JSON
    $images = $product->images;

    // Check if the image to be deleted exists in the product's images array
    if (($key = array_search($request->image, $images)) !== false) {
        // Delete the image file from the disk
        $disk = Storage::disk('spaces');
        if ($disk->exists(env('PRODUCT_IMAGE_PATH') . $request->image)) {
            $disk->delete(env('PRODUCT_IMAGE_PATH') . $request->image);
        }

        // Remove the image from the array
        unset($images[$key]);

        // Reindex the array and save it back to the product
        $product->images = array_values($images);
        $product->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'Image not found.']);
}

public function getChildCategories($parentId)
{
    $childCategories = Category::where('parent_id', $parentId)
        ->active()
        ->get();
    
    return response()->json($childCategories);
}

}
