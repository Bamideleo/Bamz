@extends('front.layout')
@section('title','Shop page')
@section('content')
<main role="main">
<div class="container">
<div class="jumbotron">
<center>
<h1 class="display-4" style="color:gray;">ONLINE <span style="color:orange;">SHOPPING</span></h1>
  <p class="lead">
    <a class="btn btn btn-lg" href="#" role="button" style="color:white; background:orange;">Learn more</a>
    <a class="btn btn-dark btn-lg" href="#" role="button">Learn more</a>
  </p>
  </center>
</div>
</div>

<div class="album py-5 bg-light">
  <div class="container">
    <div class="row">
    @forelse($product as $products)
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm" style="border:1px solid orange" >
        <center>
          <img class="card-img-top" src="{{asset('/storage/images/'.$products->image)}}"
          id="card"  alt="image">
          </center>
          <div class="card-body">
          <p class="card-text" style="color:orange">{{$products->pro_name}}</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
              <a href="{{url('productDetail/'.$products->id)}}" class="btn btn-sm btn-outline-warning"
              style="border:1px solid orange; color:gray"> View Product</a>
              <a href="{{url('cart/addItem/'.$products->id)}}" class="btn btn-sm btn-outline-warning"
              style="border:1px solid orange; color:gray">Add To Cart</a>
              </div>
            </div>
          </div>
        </div>
      </div> 
      @empty
      <h3>No Product</h3>
      @endforelse
  </div>
</div>

</main>

@endsection