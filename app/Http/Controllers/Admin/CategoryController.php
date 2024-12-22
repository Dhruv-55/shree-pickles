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
            'categories' => Category::whereNull('parent_id')->paginate(20)
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
                'image' => $category_image,
            ]);
          });

            return redirect()->route('admin-category-view')->with(['success' => 'Category Created Successfully']);
        }
        return view('admin.category.create',[
            
        ]);
    }
    public function update(Request $request){

        if(! $category = Category::where('id',$request->id)->first() )
            return redirect()->back()->with(['error' => 'Category Not Found']);


        if($request->isMethod('post')){

            

            if ($request->image) {
                $category_image = null;
                if ($request->hasFile('image') && $request->file('image')->isValid()){
                        $disk = Storage::disk('spaces');
                        $category_image = (string) Str::random(4).".".$request->file('image')->getClientOriginalExtension();
                        $disk->delete( env('CATEGORY_IMAGE_PATH') . $category_image );
                        $disk->put(env('CATEGORY_IMAGE_PATH') . $category_image, file_get_contents($request->file('image')->path()));
                        $category->image  = $category_image;
    
                    }
                }
                
                $category->status = $request->status;
                $category->name = $request->name;
                $category->slug = Str::slug($request->slug);
                $category->description = $request->description;
                // $category->image = $category_image;
                $category->save();
    
                return redirect()->route('admin-category-view')->with(['success' => 'Category Updated Successfully']);
            

        }

        return view('admin.category.update',[
            'category' => $category
        ]);
    }

    public function viewChild($id){
        $parent_category = Category::where('id',$id)->first();
        $categories = Category::where('parent_id',$id)->paginate(10);
        return view('admin.category.child.index',[
            'parent_category' => $parent_category,
            'categories' => $categories
        ]);
    }

    public function childCreate(Request $request){
        $parent_categories = Category::where('status',1)->whereNull('parent_id')->get();
        if($request->isMethod('post')){
            $this->validate($request,[
                'name' => 'required',
                'slug' => 'required',
                'parent_id' => 'required'
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
                'image' => $category_image,
                'parent_id' => $request->parent_id
            ]);
          });

            return redirect()->route('admin-category-view-child',['id' => $request->parent_id])->with(['success' => 'Category Created Successfully']);
        }
        return view('admin.category.child.create',[
            'parent_categories' => $parent_categories
        ]);
    }

    public function childUpdate(Request $request){
        if(! $category = Category::where('id',$request->id)->first() )
            return redirect()->back()->with(['error' => 'Category Not Found']);

        if($request->isMethod('post')){
            $category->status = $request->status;
            $category->name = $request->name;
            $category->slug = Str::slug($request->slug);
            $category->description = $request->description;
            $category->image = $request->image;
            $category->save();
            if ($request->image) {
                if ($request->hasFile('image') && $request->file('image')->isValid()){
                    $disk = Storage::disk('spaces');
                    $category_image = (string) Str::random(4).".".$request->file('image')->getClientOriginalExtension();
                    $disk->delete( env('CATEGORY_IMAGE_PATH') . $category_image );
                    $disk->put(env('CATEGORY_IMAGE_PATH') . $category_image, file_get_contents($request->file('image')->path()));
                    $category->image  = $category_image;

                }
            }
            $category->save();
            return redirect()->route('admin-category-view-child',['id' => $category->parent_id])->with(['success' => 'Category Updated Successfully']);
        }

        return view('admin.category.child.update',[
            'category' => $category
        ]);
    }
}
