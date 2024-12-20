<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'terms' => 'required',
            ]); 
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            session(['user' => $user]);
            return redirect()->route('website-home')->with('success', 'Registration successful');
        }
        return view('website.auth.register');
    }

    public function login(Request $request){
       if($request->isMethod('post')){
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return redirect()->back()->with('error', 'Invalid credentials');
        }
            session(['user' => $user]);
            return redirect()->route('website-home')->with('success', 'Login successful');
        }
        return view('website.auth.login');
    }

    public function logout(){
        session()->forget('user');
        return redirect()->route('website-home');
    }
}
