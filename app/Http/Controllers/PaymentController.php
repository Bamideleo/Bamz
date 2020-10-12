<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
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

class PaymentController extends Controller
{
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
  foreach(Cart::getcontent() as $item){
  $item1[] = (new Item())
      ->setName($item->name)
      ->setCurrency('USD')
      ->setQuantity($item->quantity)
      ->setPrice($item->price);
  }
  $itemList = new ItemList();
  $itemList->setItems($item1);

  $details = new Details();
  $details->setShipping($item->conditions->parsedRawValue)
  ->setSubtotal($item->price);

  $amount = new Amount();
  $amount->setCurrency("USD")
  ->setTotal($item->price + $item->conditions->parsedRawValue)
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

      foreach(Cart::getcontent() as $item){
      $transaction = new Transaction();
      $amount = new Amount();
      $details = new Details();
      $details->setShipping($item->conditions->parsedRawValue)
      ->setSubtotal($item->price);
      $amount->setCurrency('USD');
      $amount->setTotal($item->price + $item->conditions->parsedRawValue);
      $amount->setDetails($details);
      $transaction->setAmount($amount);
      $execution->addTransaction($transaction);
      }
     
      $result = $payment->execute($execution, $apiContext);
      return $result;
  }
}
