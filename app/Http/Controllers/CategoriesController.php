<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categories;
class CategoriesController extends Controller
{
    public function categories()
    { 
        $brand = Categories::all();
        return view('admin.product.categoies',compact('brand'));
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);
        Categories::create($request->all());
       return redirect()->back();    
    }
    public function destroy(Request $request,Categories $id)
    {
     $id->delete();
       return redirect()->back();    
    }
}
