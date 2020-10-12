@extends('front.layout')
@section('title','Order Page')
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
<div class="col-md-8">
<h3 style="color:gray"><span style="color:orange">{{ucwords(Auth::user()->name)}}</span> Your Order</h3>
<table class="table table-hover" style="color:gray">
  <thead>
    <tr>
      <th>Date</th>
      <th>Product Name</th>
      <th>Product Code</th>
      <th>Order Total</th>
      <th>Order Status</th>
    </tr>
  </thead>
  <tbody>
  @foreach($order as $orders)
    <tr>
      <td>{{$orders->created_at}}</td>
      <td>{{$orders->pro_name}}</td>
      <td>{{$orders->pro_code}}</td>
      <td>{{$orders->total}}</td>
      <td><span class="badge badge-warning text-white">{{$orders->status}}</span></td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
</div>
</section>
@endsection