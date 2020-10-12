<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\wishlist_model;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product=product::all();
        $cart = Cart::getContent();
        return view('front.home', compact('product','cart'));
    }
    public function shop()
    {
        $product=product::all();
        $cart = Cart::getContent();
        return view('front.shop', compact('product','cart'));
    }
    public function showcategory($id)
    {
       $category = product::where('categories',$id)->get();
       $cat = $id;
       $repro = product::where('categories',$id)->inRandomOrder()->take(3)->get();
       $foundPro = product::where('categories','!=',$id)->inRandomOrder()->take(4)->get();
       $cart = Cart::getContent();
       return view('front.category', compact('category','cat','cart','repro','foundPro'));
    }
    public function productdetail($id)
    {
        $cart = Cart::getContent();
        $details = product::where('id',$id)->get();
        $cat = $id;
        $repro = product::where('categories',$id)->inRandomOrder()->take(3)->get();
        $foundPro = product::where('categories','!=',$id)->inRandomOrder()->take(3)->get();
        return view('front.productDetail',compact('details','cart','foundPro'));
    }
    public function Wishlist()
    {
        $cart = Cart::getContent();
       $details = DB::table('wishlist_')->leftjoin('products','products.id','=','wishlist_.pro_id')->get();
       $foundpro = DB::table('products')->inRandomOrder()->take(3)->get();
       return view('front.wishlist',compact('details','cart','foundpro'));
    }
    public function AddWish(Request $request)
    {
        $wishlist = new wishlist_model();
        $wishlist->user_id = Auth::user()->id;
        $wishlist->pro_id = $request->pro_id;
        $wishlist->save();
        $cart = Cart::getContent();
        $details = DB::table('products')->where('id',$request->pro_id)->get();
        $foundPro = product::where('categories','!=',$request->pro_id)->inRandomOrder()->take(3)->get();
        return view('front.productDetail',compact('details','cart','foundPro'));
    }
    public function about()
    {
        $cart = Cart::getContent();
        return view('cart.about',compact('cart'));
    }
    public function privacy()
    {
        $cart = Cart::getContent();
        return view('cart.privacy',compact('cart'));
    }
    public function shipping()
    {
        $cart = Cart::getContent();
        return view('cart.shipping',compact('cart'));
    }
    public function exchange()
    {
        $cart = Cart::getContent();
        return view('cart.exchange',compact('cart'));
    }
    public function destroy($id)
    {
        $details = DB::table('wishlist_')->where('pro_id','=',$id)->delete();
        return redirect()->back()->with('message','Item has been remove from wishlist');
    }
}
