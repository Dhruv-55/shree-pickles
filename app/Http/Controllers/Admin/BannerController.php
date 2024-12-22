<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
class BannerController extends Controller
{
    public function index(){
        $banners = Banner::paginate(20);
        return view('admin.banner.index',compact('banners'));
    }

    public function create(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'title' => 'required',
                // 'link' => 'required',
                'type' => 'required',
                'position' => 'required',
            ]);
            $data = $request->all();
            $banner = new Banner();
            $banner->title = $data['title'];
            $banner->link = $data['link'];
            $banner->type = $data['type'];
            $banner->position = $data['position'];
            $banner->save();
            if($request->hasFile('image')){
                $image = $request->file('image');
                $disk = Storage::disk('spaces');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $disk->put(env('BANNER_IMAGE_PATH') . $imageName, file_get_contents($request->file('image')->path()));
                $banner->image = $imageName;
                $banner->save();
            }
            return redirect()->route('admin-banner-view')->with('success','Banner created successfully');
        }
        return view('admin.banner.create');
    }

    public function update(Request $request){
        $banner = Banner::where('id',$request->id)->first();
        if($request->isMethod('post')){
            $request->validate([
                'title' => 'required',
                // 'link' => 'required',
                'type' => 'required',
                'position' => 'required',
            ]);
            $data = $request->all();
            $banner->title = $data['title'];
            $banner->link = $data['link'];
            $banner->type = $data['type'];
            $banner->position = $data['position'];
            $banner->save();
            if($request->hasFile('image')){
                if($banner->image){
                    $disk = Storage::disk('spaces');
                    $disk->delete(env('BANNER_IMAGE_PATH') . $banner->image);
                }
                $image = $request->file('image');
                $disk = Storage::disk('spaces');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $disk->put(env('BANNER_IMAGE_PATH') . $imageName, file_get_contents($request->file('image')->path()));
                $banner->image = $imageName;
                $banner->save();
            }
            return redirect()->route('admin-banner-view')->with('success','Banner updated successfully');
        }   

        return view('admin.banner.update',compact('banner'));
    }
}
