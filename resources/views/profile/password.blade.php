@extends('front.layout')
@section('title','Password Page')
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
<h3 style="color:gray"><span style="color:orange">{{ucwords(Auth::user()->name)}}</span> Update Your Password</h3>
@if(session()->has('message'))
<div class="alert alert-success">{{session()->get('message')}}</div>
@elseif(session()->has('error'))
<div class="alert alert-danger">{{session()->get('error')}}</div>
@endif
<hr>
<form action="{{url('/profile/updatePassword')}}" method="post"> 
@csrf
@method('put')
  <div class="form-group">
    <label for="exampleInputEmail1">Current Password</label>
    <input type="password" class="form-control" name="oldpassword" placeholder="Current Password">
    <span class="text-danger">{{$errors->first('password')}}</span>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password" class="form-control" name="newpassword" placeholder="New Password">
    <span class="text-danger">{{$errors->first('newpassword')}}</span>
  </div>  
  <button type="submit" class="btn btn" style="background:orange;color:white">Update Password</button>
  <br><br>
</form>

</div>
</div>
</div>
</section><br><br>
@endsection