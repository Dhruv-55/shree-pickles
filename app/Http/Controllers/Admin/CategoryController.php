<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request){
        return view('admin.category.index',[
            'categories' => Category::paginate(20)
        ]);
    }

    public function create(Request $request){

        if($request->isMethod('post')){
            $this->validate($request,[
                'name' => 'required',
                'slug' => 'required'
            ]);           

            
          DB::transaction(function() use($request) {

            $category_image = null;

            if ($request->image) {
                if ($request->hasFile('image') && $request->file('image')->isValid()){
                    $disk = Storage::disk('spaces');
                    $category_image = (string) Str::random(4).".".$request->file('image')->getClientOriginalExtension();
                    $disk->put(env('CATEGORY_IMAGE_PATH') . $category_image, file_get_contents($request->file('image')->path()));

                }
            }

            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
                'description' => $request->description,
                'image' => $category_image
            ]);
          });

            return redirect()->route('admin-category-view')->with(['success' => 'Category Created Successfully']);
        }

        return view('admin.category.create');
    }
    public function update(Request $request){

        if(! $category = Category::where('id',$request->id)->first() )
            return redirect()->back()->with(['error' => 'Category Not Found']);


        if($request->isMethod('post')){

            $category_image = null;

                if ($request->image) {
                    if ($request->hasFile('image') && $request->file('image')->isValid()){
                        $disk = Storage::disk('spaces');
                        $category_image = (string) Str::random(4).".".$request->file('image')->getClientOriginalExtension();
                        $disk->delete( env('CATEGORY_IMAGE_PATH') . $category_image );
                        $disk->put(env('CATEGORY_IMAGE_PATH') . $category_image, file_get_contents($request->file('image')->path()));
                        $category->image  = $category_image;
    
                    }
                }
                
                $category->status = $request->status;
                $category->save();
    
                return redirect()->route('admin-category-view')->with(['success' => 'Category Updated Successfully']);
            

        }

        return view('admin.category.update',[
            'category' => $category
        ]);
    }
}
