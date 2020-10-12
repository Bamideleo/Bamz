<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use Illuminate\Support\Facades\Hash;
class AdminRegisterController extends Controller
{
    public function __construct()
    {
      
        $this->middleware('guest:admin');
    }
    public function showRegister()
    {
      return view('auth.adminReg');
    }
    public function Register(Request $request)
    {
        $this->validate($request,
        [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8'],
        ]
     ); 
     try {
         $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
         ]);

         Auth::guard('admin')->loginUsingId($admin->id);
        return redirect(route('admin.index'));

     } catch (\Exception $e) {
         return redirect()->back()->withInput($request->only('name','email'));
     }
    }
}
