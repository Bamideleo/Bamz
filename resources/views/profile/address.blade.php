@extends('front.layout')
@section('title','Address Page')
@section('content')
<br><br>
<style>
table td{padding:10px;}
</style>
<section id="cart_items">
<div class="container">
<div class="row">
<div class="col-md-4 well well-sm">
<div class="card border-secondary mb-3" style="max-width: 18rem;">
  <div class="card-header" style="color:gray">Profile Menu</div>
  @include('profile.menu')
</div>
</div>
<div class="col-md-8" style="color:gray">
<h3 style="color:gray"><span style="color:orange">{{ucwords(Auth::user()->name)}}</span> Your Address</h3>
@if(session()->has('message'))
<div class="alert alert-success">{{session()->get('message')}}</div>
@elseif(session()->has('error'))
<div class="alert alert-danger">{{session()->get('error')}}</div>
@endif
<hr>
<form action="{{url('/profile/updateAddress')}}" method="post">
@foreach($address as $add) 
@csrf
  <div class="form-group">
    <label for="exampleInputEmail1">FirstName</label>
    <input type="text" class="form-control" name="firstname" value="{{$add->firstname}}" placeholder="firstname">
    <span class="text-danger">{{$errors->first('firstname')}}</span>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Lastname</label>
    <input type="text" class="form-control" name="lastname" value="{{$add->lastname}}" placeholder="Lastname">
    <span class="text-danger">{{$errors->first('lastname')}}</span>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Phone Number</label>
    <input type="text" class="form-control" name="phone" value="{{$add->phone}}" placeholder="Phone Number">
    <span class="text-danger">{{$errors->first('phone')}}</span>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Street</label>
    <input type="text" class="form-control" name="street" value="{{$add->street}}" placeholder="Street">
    <span class="text-danger">{{$errors->first('state')}}</span>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">State</label>
    <input type="text" class="form-control" name="state" value="{{$add->state}}" placeholder="State">
    <span class="text-danger">{{$errors->first('state')}}</span>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">City</label>
    <input type="text" class="form-control" name="city" value="{{$add->city}}" placeholder="City">
    <span class="text-danger">{{$errors->first('city')}}</span>
  </div>
  <button type="submit" class="btn btn" style="background:orange;color:white">Update Address</button>
  <br><br>
  @endforeach
</form>

</div>
</div>
</div>
</section>
@endsection