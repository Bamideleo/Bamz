@extends('front.layout')
@section('title','CheckOut Page')
@section('content')

<br>
<main role="main" class="col-md-8 ml-sm-auto col-lg-10 px-4">
<h3 style="color:gray"><span style="color:orange;text-decoration:underline">CHECKOUT</span> Page</h3>
<!-- shipping address section start -->
<form action="{{'/check/formValidate'}}" method="post">
<div class="row" style="color:gray">
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
      <div class="card-header">
     <h5><span class="badge badge-pill badge-warning">1</span> Shipping Address</h5>
      </div>
      <p class="card-text">You already have an account with us. Sign in continue as guest.</p>
  <div class="row">
  @csrf
    <div class="col">
    <span class="text-danger" style="font-size:12">{{$errors->first('firstname')}}</span>
      <input type="text" class="form-control" name="firstname" placeholder="First name">
    </div>
    <div class="col">
    <span class="text-danger" style="font-size:12">{{$errors->first('lastname')}}</span>
      <input type="text" class="form-control" name="lastname" placeholder="Last name">
    </div>
  </div>
  <div class="row" style="margin-top:10px;">
    <div class="col">
    <span class="text-danger" style="font-size:12">{{$errors->first('street')}}</span>
      <input type="text" class="form-control" name="street" placeholder="Street">
    </div>
    <div class="col">
    <span class="text-danger" style="font-size:12">{{$errors->first('city')}}</span>
      <input type="text" class="form-control" name="city" placeholder="City">
    </div>
  </div>
  <div class="row" style="margin-top:10px">
    <div class="col">
    <span class="text-danger" style="font-size:12">{{$errors->first('phone')}}</span>
      <input type="text"  name="phone" class="form-control" placeholder="Phone Number">
    </div>
    <div class="col">
    <span class="text-danger" style="font-size:12">{{$errors->first('state')}}</span>
    <select name="state" class="form-control">
    <option selected disabled>Select state</option>
    <option>Abia</option>
    <option>Adamawa</option>
    <option>Akwa Ibom</option>
    <option>Anambra</option>
    <option>Bauchi</option>
    <option>Bayelsa</option>
    <option>Benue</option>
    <option>Borno</option>
    <option>Cross River</option>
    <option>Delta</option>
    <option>Ebonyi</option>
    <option>Edo</option>
    <option>Ekiti</option>
    <option>Enugu</option>
    <option>Gombe</option>
    <option>Imo</option>
    <option>Jigawa</option>
    <option>Kaduna</option>
    <option>Kano</option>
    <option>Katsina</option>
    <option>Kebbi</option>
    <option>Kogi</option>
    <option>Kwara</option>
    <option>Lagos</option>
    <option>Nasarawa</option>
    <option>Niger</option>
    <option>Ogun</option>
    <option>Ondo</option>
    <option>Osun</option>
    <option>Oyo</option>
    <option>Plateau</option>
    <option>Rivers</option>
    <option>Sokoto</option>
    <option>Taraba</option>
    <option>Yobe</option>
    <option>Zamfara</option>
    <option>FCT</option>

    </select>
    </div>
  </div>
      </div>
    </div>
  </div>
<!-- shipping address section end -->
  <!-- shipping section start  -->
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
      <div class="card-header">
     <h5><span class="badge badge-pill badge-warning">2</span> Shipping Methods</h5>
      </div>
      @foreach($cart as $cat)
       <span>&#8358; {{$cat->conditions->parsedRawValue}}</span>
        @endforeach
      </div>
    </div>
  </div>
<!-- shipping address section end -->

<!-- payment section start -->
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
      <div>
      <h5><span class="badge badge-pill badge-warning">3</span>  Payment Methods</h5>
      </div>
      <span class="text-danger" style="font-size:12">{{$errors->first('payment_type')}}</span>
      <div class="form-check">
  <input class="form-check-input" type="radio" name="payment_type" id="exampleRadios1" 
  value="paypal" >
  <label class="form-check-label" for="exampleRadios1">
  <p>You will be redirected to Paypal payment gateway</p>
  </label>
  <hr>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="payment_type" id="viacard" value="card/ussd">
  <label class="form-check-label" for="exampleRadios2">
   <p>Pay via card, USSD, Visa QR [Get 2% of the Total Price]</p> 
  </label>
</div>
<hr>
<div class="form-check">
  <input class="form-check-input" type="radio" name="payment_type" id="exampleRadios3" 
    value="bank_transfer"
  <label class="form-check-label" for="exampleRadios3">
   <p>Bank transfer payment [Get 2% of the total price]</p>
  </label>
</div>
<hr>
<div class="form-check">
  <input class="form-check-input" type="radio" name="payment_type" id="exampleRadios3" 
  value="cash_on_delivery">
  <label class="form-check-label" for="exampleRadios3">
   <p> Cash On Delivery</p>
  </label>
</div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- payment section end -->
<div class="row" style="color:gray">
  <div class="col-sm-4" style="margin-top:-5%">
    <div class="card">
      <div class="card-body">
      <h6>Apply Discount Code</h6>
      <input type="text" class="form-control" placeholder="Enter Discount Code">
      <a href="#!"class="btn btn-secondary" style="margin-top:10px">Apply Discount</a>
      </div>
    </div>
  </div>
  <!-- order summary section start -->
  <div class="col-sm-4" style="margin-top:-18%">
    <div class="card">
      <div class="card-body">
      <div class="card-header">
      <h5><span class="badge badge-pill badge-warning">4</span>  Order Summary</h5>
      </div>
      <table class="table">
  <thead>
    <tr>
      <th>Product Name</th>
      <th>Qty</th>
      <th>Subtotal</th>
    </tr>
  </thead>
  <tbody>
  @foreach($cart as $carts )
    <tr>
      <td><img src="{{asset('/storage/images/'.$carts->attributes->img)}}" alt="image" width="100"><br>
    <a href="{{'/home'}}">{{$carts->name}}</a>
    </td>
      <td><input type="number" id=""  name="qty" value="{{$carts->quantity}}" style="width:120%"></td>
      <td><span>&#8358;</span>{{cart::getsubtotal()}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<h6>Subtota: <span > &#8358; {{cart::getsubtotal()}}</span></h6>
<h6>Order Total: <span > &#8358; {{cart::getsubtotal()}}</span>  </h6>
      </div>
    </div>
    <center>
    <button class="btn btn-lg" style="margin-top:50px; background:orange;color:white; width:90%">
    PLACE ORDER</button>
    </center>
    @include('cart.pay')&nbsp;&nbsp;
  </div>
  </div>
   <!-- order summary section end -->
  </form>
  <form form action="{{route('create-payment')}}" method="post">
  @csrf
  <div class="container">
  <input type="submit" class="btn btn-primary" value="Paypal">
  
  </div>
  </form>

 
</main>
<br><br>
@endsection