<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminLoginController extends Controller
{
    public function __construct()
    {
      
        $this->middleware('guest:admin')->except('Logout');
    }
    public function showLogin()
    {
       return view('auth.adminlog');
    }
    public function Login(Request $request)
    {
       $this->validate($request,
       [
           'email'=> 'required|string|email',
           'password'=> 'required|string|min:8',
       ]
    ); 
    //Attempt to login  
    if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password], '$request->remember')){
        // return redirect()->intended(route('admin.index'));
        
    }
    // not sucessful 
    return redirect()->back()->with($request->only('email','remember'));
    }
    public function Logout(Request $request)
    {
       Auth::guard('admin')->logout();
       return redirect(route('admin.index'));
    }
}
