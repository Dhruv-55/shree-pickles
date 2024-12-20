<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request){

        if($request->isMethod('POST')){

            $this->validate($request,[
             'email' => 'required',
             'password' => 'required',
            ],
            [
             'email.required' => 'Email Is Required',
             'password.required' => 'Password Is Required'
            ]);
 
            if( !$admin = Admin::where('username',$request->email)->orWhere('email',$request->email)->first() )
                 return redirect()->back()->with(['error' => 'Admin Not Found']);
 
              if( ! Hash::check($request->password,$admin->password) )   
                  return redirect()->back()->with(['error' => 'Invalid Password']);
 
             if($admin->status == Admin::INACTIVE)
                 return redirect()->back()->with(['error' => 'Your Account Is In Active..Kindly Contact Developers']);
 
 
             session(['admin' => $admin]);
             return redirect()->route('admin-dashboard')->with(['success' => 'Login Successful']);
         }
       return view('admin.login');
    }
}
