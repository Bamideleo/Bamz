@extends('front.layout')
@section('title','Cart Page')
@section('content')
<br>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
<h3 style="color:gray"><span style="color:orange;text-decoration:underline">Shopping</span> Cart</h3>
@if(session()->has('message'))
<div class="alert alert-success">{{session()->get('message')}}</div>
@elseif(session()->has('error'))
<div class="alert alert-danger">{{session()->get('error')}}</div>
@endif
<br>
<a href="{{'/home'}}" class="btn btn-lg" style="background:orange; color:white">Continue Shopping</a>
<br><br>
@if($cart->count()>0)
<h6 style="color:orange">{{$cart->count()}} Item(s) in shopping cart</h6>
<div class="table-responsive">
<table class="table table-hover">
        <tbody id="table">
       @foreach($cart as $item)
        <tr>
        <td><img src="{{asset('/storage/images/'.$item->attributes->img)}}" alt="image" width="100"></td>
        <td>{{$item->name}} <br>
        {{$item->attributes->info}}
        <br>
       <h6> {{$item->attributes->stock}} Avaliable Items</h6>
        </td>
        <td><span>&#8358;</span> {{$item->price}}</td>
        <td>
        <form action="{{'/cart/'.$item->id.'/update'}}" method="post">
        @csrf
        @method('put')
        <input type="hidden"  class="form-control" name="proId" value="{{$item->id}}">
        <input type="number" id="qty"  name="qty" value="{{$item->quantity}}">
        <input type="submit" class="btn btn-sm btn-default" value="Update" 
        style="background:orange;color:white">
        </form>
        <td>
      <form action="{{'/cart/'.$item->id.'/destroy'}}" method="post">
        @csrf
        @method('delete')
        <input type="submit" class="btn btn-sm btn-default" value="Remove" style="color:red">
        </form>
        </td>
        </tr>
       @endforeach
        </tbody>
        </table>
</div>

@else
<h6 style="color:orange">no items in shopping cart</h6>
@endif
<br>
<div class="container">
  <div class="row">
    <div class="col">
    <div class="form-group" style="color:gray">
    <form action="">
    <label for="formGroupExampleInput">Countary</label>
        <select name="" id="pname" class="form-control">
        <option value="">one</option>
        <option value="">one</option>
        <option value="">one</option>
        </select>
        <label for="formGroupExampleInput">State</label>
        <select name="" id="pname" class="form-control">
        <option value="">one</option>
        <option value="">one</option>
        <option value="">one</option>
        </select>
        <label for="formGroupExampleInput">Zip Code</label>
    <input type="text" class="form-control" id="pname" name="Zip code" placeholder="Zip code">
        </div>
        </form>
    </div>
    <div class="col">
    <ul class="list-group" style="color:gray">
  <li class="list-group-item">Cart sub Total cost:  <span>&#8358;</span> {{Cart::getSubTotal()}}</li>
  <li class="list-group-item">Shipping cost free</li>
  <li class="list-group-item" style="color:black"><b>Total:  <span>&#8358;</span> {{Cart::getTotal()}}</b></li>
</ul>
<br>
<a href="{{'/check'}}" class="btn btn-lg" style="background:orange; color:white">GO TO CHECKOUT</a>
    </div>
  </div>
</div>
<br>
  <div class="card-header" style="color:orange">
   WE FOUND OTHER PRODUCTS YOU MIGHT LIKE!
  </div>
 <br> 
<div class="row">
@foreach($foundpro as $found)
<div class="col-sm-4">
<div class="card mb-4 shadow-sm" style="border:1px solid orange; padding-bottom:20px">
      <center>
        <a href="{{url('productDetail/'.$found->id)}}">
  <img src="{{asset('/storage/images/'.$found->image)}}" alt="image" id="card">   
        </a>
    </center>
</div>
</div>
  @endforeach
</div>
</main>
<br><br><br>
@endsection