<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\Categories;
use Illuminate\Http\UploadedFile;
class ProductController extends Controller
{

    public function index()
    {
        return view('admin.index');
    }
public function create(Request $request)
{   $brand = Categories::all();
    return view('admin.product.create',compact('brand'));
}
public function store(Request $request)
{ 
    $this->validate($request,[
        'pro_name'=>'required',
        'pro_code'=>'required',
        'pro_price' =>'required|numeric',
        'pro_info' =>'required',
        'ship_price' =>'required|numeric',
        'stock' =>'required|numeric',
        'categories'=>'required',
        'image'=>'required',
       ]);
    if($request->hasfile('image')){
        $filename= $request->image->getClientOriginalName();
        $request->image->storeAs('images',$filename,'public');
        $inputs['image'] = $filename;
    }
    product::create([
        'pro_name'=> $request->get('pro_name'),
        'pro_code'=> $request->get('pro_code'),
        'pro_price'=> $request->get('pro_price'),
        'pro_info'=> $request->get('pro_info'),
        'ship_price'=> $request->get('ship_price'),
        'stock'=> $request->get('stock'),
        'categories'=> $request->get('categories'),
        'image'=> $filename
    ]);
    // product::create($request->all());
    // return redirect(route('dit.show'));
    return redirect()->back()->with('message','Product Has Been Added');
}
public function show(){
    $product =  product::all();
    return view('admin.product.index',compact('product'));
}
public function edit(product $dit)
{ 
    return view('admin.product.edit', compact('dit'));
}
public function update(Request $request, product $dit)
{
//  $dit->update(['pro_name'=>$request->pro_name],['pro_code'=>$request->pro_code],['pro_info'=>$request->pro_info],
//  ['pro_price'=>$request->pro_price],['ship_price'=>$request->ship_price]);
//  return redirect(route('dit.show'));
}
public function upload(Request $request)
{
    if($request->hasfile('image')){
        $filename= $request->image->getClientOriginalName();
        $request->image->storeAs('images',$filename,'public');
        auth()->user()->products()->update(['image'=>$filename]);
    }
    
    return redirect(route('dit.show'));
}
public function destroy(product $dit)
{
   $dit->delete();
    return redirect()->back();
}
}
