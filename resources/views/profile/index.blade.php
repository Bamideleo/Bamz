@extends('front.layout')
@section('title','Profile Page')
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
  <div class="card-header">Profile Menu</div>
  @include('profile.menu')
</div>
</div>
<div class="col-md-8">
<ol class="breadcrumb">
   <li><h3 style="color:orange">Welcome <span style="color:gray">{{ucwords(Auth::user()->name)}}</span></h3></li>
    <table broder-o class="align-center">
    <tr >
    <td><a href="{{'/order'}}" class="btn btn-success">My Order</a></td>
    <td><a href="{{'/address'}}" class="btn btn-success">My Address</a></td>
    <td><a href="{{'/password'}}" class="btn btn-success">Change Password</a></td>
    </tr>
    </table>
  </ol>
</div>
</div>
</div>
</section>
@endsection