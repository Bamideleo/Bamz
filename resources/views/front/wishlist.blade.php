@extends('front.layout')
@section('title','Wishlist Page')
@section('content')
<br><br>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
<div class="container">
<h3 style="color:gray"><span style="color:orange;text-decoration:underline">Shopping</span> List</h3>
@if(session()->has('message'))
<div class="alert alert-success">{{session()->get('message')}}</div>
@elseif(session()->has('error'))
<div class="alert alert-danger">{{session()->get('error')}}</div>
@endif
    <div class="row">
    <?php
    if($details->isEmpty()){?>

    <h2 style="color:gray">Sorry,product not found</h2>
    <?php } else{?>
        <div class="table-responsive">
<table class="table table-hover">
        <tbody id="table">
        @foreach($details as $detail)
        <tr>
        <td>
        <a href="{{url('/productDetail/'.$detail->id)}}">
        <img  src="{{asset('/storage/images/'.$detail->image)}}" alt="image" width="100">
        </a>
        </td>
        <td>
        <h6 class="text-danger"><span>&#8358;</span> {{$detail->ship_price}}</h6>
        </td>
        <td>
        
        <p>
        <a href="{{url('/productDetail/'.$detail->id)}}"> {{$detail->pro_name}}</a>
        </p>
        </td>
        <td>
        <a href="{{url('cart/addItem/'.$detail->id)}}" class="btn btn-sm btn-outline-warning"
                style="border:1px solid orange; color:gray">Add To Cart</a>
        </td>
        <td>
        <form action="{{'/destroy/'.$detail->id}}" method="post">
        @csrf
        @method('delete')
        <input type="submit" class="btn btn-sm btn-default" value="Remove From Wishlist" style="color:red">
        </form>
        </tr>
        @endforeach
        </tbody>
        </table> 
    </div>
    <?php }?>
</div>
</div>
<br>
  <div class="card-header" style="color:orange;">
  WE FOUND OTHER PRODUCTS YOU MIGHT LIKE!
  </div>
 <br> 

<div class="row">
@foreach($foundpro as $found)
  <div class="col-sm-4">
  <div class="card mb-4 shadow-sm" style="border:1px solid orange; padding-bottom:20px">
      <center>
      <a href="{{url('productDetail/'.$found->id)}}">
      <img  src="{{asset('/storage/images/'.$found->image)}}" alt="image" id="card"> 
    </a>
          </center>
    </div>
  </div>
  @endforeach
</div>
</main>
<br><br>
@endsection