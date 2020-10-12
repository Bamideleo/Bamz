<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\address_model;
use App\order_model;
use Cart;
use App\product;
use App\User;
use Illuminate\Support\Facades\Auth;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;

class CheckOutController extends Controller
{
    public function index()
    {
        // $cart = Cart::getcontent();
        //  return view('cart.check',compact('cart'));
       if(Auth::check()){

           $cart = Cart::getcontent();
        //    foreach($cart as $carts){
        //     return $cart;
            
        //   }
        
            
           
           
        //                
           return view('cart.check',compact('cart'));
       } 
       else{
           return redirect('/login');
       }
    }
    public function address(Request $request)
    {
        
     $this->validate($request,[
        'firstname'=>'required|min:8|max:35',
        'lastname'=>'required|min:6|max:15',
        'street' =>'required',
        'city' =>'required',
        'phone' =>'required|numeric',
        'state' =>'required',
        'payment_type'=>'required'
       ]);
       $request['user_id'] = Auth::user()->id;
       address_model::create($request->all());
       $cart = Cart::getcontent();
       order_model::OrderCreate();
       Cart::clear();
       return view('profile.thankyou',compact('cart'));
    }
    
    public function create()
    {
        
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AT5lqOF26iK9zjesKhRlSNJ0jPSesTEEnteFOk81XJg99G011MxgJ7iGXwTi295HSfUMw_PNblOaueUG',     // ClientID
                'EF7HBvnwLFNQIAskArN8oqElCOeNmalAx5VRW3f8jCgy_zh5xV-63DZ5SOhmVd6YFdEW4Xa0S8FzGdjt'      // ClientSecret
            )
    );
    $payer = new Payer();
    $payer->setPaymentMethod("paypal");
    $item1=[];
    foreach(Cart::getcontent() as $carts){
    $item1[] = (new Item())
     ->setName($carts->name)
        ->setCurrency('USD')
        ->setQuantity($carts->quantity)
        ->setPrice($carts->price);  
    }
    $itemList = new ItemList();
    $itemList->setItems($item1);

    $details = new Details();
    $details->setShipping($carts->conditions->parsedRawValue)
    ->setSubtotal($carts->price);

    $amount = new Amount();
    $amount->setCurrency("USD")
    ->setTotal($carts->price + $carts->conditions->parsedRawValue)
    ->setDetails($details);
    
    $transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid());

    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl('http://localhost:8000/check/execute-payment')
    ->setCancelUrl('http://localhost:8000/check/cancel');

    $payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

    $payment->create($apiContext);

    return redirect($approvalUrl = $payment->getApprovalLink());

    }


    public function execute()
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AT5lqOF26iK9zjesKhRlSNJ0jPSesTEEnteFOk81XJg99G011MxgJ7iGXwTi295HSfUMw_PNblOaueUG',     // ClientID
                'EF7HBvnwLFNQIAskArN8oqElCOeNmalAx5VRW3f8jCgy_zh5xV-63DZ5SOhmVd6YFdEW4Xa0S8FzGdjt'      // ClientSecret
            )
    );
        
        $paymentId =request('paymentId');
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId(request('PayerID'));
        $items=Cart::getcontent();
       foreach($items as $item){
        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();
        $details->setShipping($item->conditions->parsedRawValue)
        ->setSubtotal($item->price);
        $amount->setCurrency('USD');
        $amount->setTotal($item->price + $item->conditions->parsedRawValue);
        $amount->setDetails($details);
        $transaction->setAmount($amount);
        }
        $execution->addTransaction($transaction);

        $result = $payment->execute($execution, $apiContext);
        return $result;
    }
   
}
