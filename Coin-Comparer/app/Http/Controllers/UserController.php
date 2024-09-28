<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //
    public function create(Request $request){
                
        if($request->session()->has('email')){
            return view('coinmonitor');
        }
        return view('createuser');
    }


    public function login(Request $request){
        if($request->session()->has('email')){
        return view('coinmonitor');
        }
        return view('userlogin');
    }
  
    public function logincheck(Request $request)
    {
    
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        $remember = $request->remember;
        if (Auth::attempt($credentials,$remember)) {
            $request->session()->put('email', $request->email);
            return redirect()->intended('coincomparer')
                           ->withSuccess('Signed in');
            
        }
        $request->session()->put('error-msg', "1");
        return redirect("/");
        
    }
    
    public function register(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        $request->session()->put('email', $request->email);
        return redirect()->intended('coincomparer')
        ->withSuccess('Signed in');
    }
    public function logout()
    {  
        Session::flush();
        Auth::logout();
        return redirect("/");
    }

    

}
