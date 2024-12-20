<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class BrandController extends Controller
{
   public function index(Request $request){
    
    return view('admin.brand.index',[
        'brands' => Brand::paginate(30)
    ]);
  }

  public function create(Request $request){

    if($request->isMethod('post')){
        $this->validate($request,[
            'name' => 'required',
            'slug' => 'required'
        ]);           

        $brand_image = null;
        
      DB::transaction(function() use($request) {
        if ($request->image) {
            if ($request->hasFile('image') && $request->file('image')->isValid()){
                $disk = Storage::disk('spaces');
                $brand_image = (string) Str::random(4).".".$request->file('image')->getClientOriginalExtension();
                $disk->put(env('BRAND_IMAGE_PATH') . $brand_image, file_get_contents($request->file('image')->path()));

            }
        }

        Brand::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $brand_image
        ]);
      });

        return redirect()->route('admin-brand-view')->with(['success' => 'Brand Created Successfully']);
    }

    return view('admin.brand.create');
  }

  public function update(Request $request){

    if(! $brand = Brand::where('id',$request->id)->first() )
        return redirect()->back()->with(['error' => 'Brand Not Found']);


    if($request->isMethod('post')){

        $brand_image = null;

            if ($request->image) {
                if ($request->hasFile('image') && $request->file('image')->isValid()){
                    $disk = Storage::disk('spaces');
                    $brand_image = (string) Str::random(4).".".$request->file('image')->getClientOriginalExtension();
                    $disk->delete( env('BRAND_IMAGE_PATH') . $brand_image );
                    $disk->put(env('BRAND_IMAGE_PATH') . $brand_image, file_get_contents($request->file('image')->path()));
                    $brand->image  = $brand_image;

                }
            }
            
            $brand->status = $request->status;
            $brand->save();

            return redirect()->route('admin-brand-view')->with(['success' => 'Brand Updated Successfully']);
        

    }

    return view('admin.brand.update',[
        'brand' => $brand
    ]);
}
}
