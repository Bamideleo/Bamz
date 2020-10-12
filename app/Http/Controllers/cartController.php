<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\product;
class cartController extends Controller
{
    public function index()
    { 
        $cart = Cart::getContent();
        $foundpro = product::inRandomOrder()->take(3)->get();
        // return $foundpro;
        return view('cart.index',compact('cart','foundpro'));
}
public function addItem($id)
{
    $product = product::findOrFail($id);
    $saleCondition = new \Darryldecode\Cart\CartCondition(array(
        'name' => 'VAT 7.5%',//query from the DB
        'type' => 'tax',
        'value' => '7.5%',//query from the DB
    ));
    Cart::add(array(
        'id' => $id, // inique row ID
        'name' => $product->pro_name,
        'price' =>$product->ship_price,
        'quantity' =>1,
        'attributes' => array('img'=>$product->image, 'info'=>$product->pro_info,'stock'=>$product->stock,'code'=>
        $product->pro_code),
        'conditions' => $saleCondition
    ));
    return redirect('cart')->with('message','Product is Added To Cart');
}
  
public function destroy($id)
{
    Cart::remove($id);
   return redirect()->back()->with('message','Product is Remove from Cart');  
}
public function updateCart(Request $request, $id)
{
   $proId = $request->proId;
   $qty = $request->qty;
   $product = product::findOrFail($proId);
   $stock = $product->stock;
   if($qty<$stock){
       
    Cart::update($id, array(
        'quantity' => $request->qty
   
  ));

return back()->with('message','Cart is Updated');
   }
   else{
       return back()->with('error','The Selected Quantity is greater than the Avaliable Stock');
   }
}
}
  
