<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class profileController extends Controller
{
    public function index()
    {
        $cart = Cart::getContent();
        return view('profile.index',compact('cart'));
    }
    public function Order()
    {
        $cart = Cart::getContent();
        $user_id = Auth::user()->id;
        $order= DB::table('order_model_product')->leftjoin('products','products.id', '=', 'order_model_product.product_id')
        ->leftjoin('orders','orders.id', '=','order_model_product.order_model_id')->where('orders.user_id','=',$user_id)
        ->get();
        
       return view('profile.order',compact('cart','order'));
    }
    public function Address()
    {
        $cart = Cart::getContent();
     $user_id = Auth::user()->id;
     $address = DB::table('address')->where('user_id',$user_id)->limit('1')->get();
        return view('profile.address',compact('address','cart'));
    }
    public function Update(Request $request)
    {    $this->validate($request,[
        'firstname'=>'required|min:8|max:35',
        'lastname'=>'required|min:6|max:15',
        'street' =>'required',
        'city' =>'required',
        'phone' =>'required|numeric',
        'state' =>'required',
       ]);
        $user_id = Auth::user()->id;
        DB::table('address')->where('user_id',$user_id)->update($request->except('_token'));
        return back()->with('message','Address is Updated');
    }
    public function Password()
    {
        $cart = Cart::getContent();
        return view('profile.password',compact('cart'));
    }
    public function updatepass(Request $request)
    {
        $oldpass = $request->oldpassword;
        $newpass = $request->newpassword;

        if(!Hash::check($oldpass,Auth::user()->password)){
            return back()->with('error','The specified password does not match the old password');
        }
        else{
            $request->user()->fill(['password' => Hash::make($newpass)])->save();
            return back()->with('message','Password Has Been Updated');
        }
    }
}
