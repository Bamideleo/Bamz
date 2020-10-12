@extends('front.layout')
@section('title','Home page')
@section('content')
<main role="main">
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{asset('image/slider_img/e.jpeg')}}" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{asset('image/slider_img/y.png')}}" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{asset('image/slider_img/me.jpg')}}" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="album py-5 bg-light">
  <div class="container">
    <div class="row">
    @forelse($product as $products)
      <div class="col-md-4">
      <div class="card mb-4 shadow-sm" style="border:1px solid orange">
        <center>
          <img class="card-img-top" src="{{asset('/storage/images/'.$products->image)}}"
         id="card"  alt="image">
          </center>
          <div class="card-body">
          <del style="color:red"><span>&#8358;</span> {{$products->pro_price}}</del>
          <span class="price text-muted float-right">&#8358; {{$products->ship_price}} </span>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
              <a href="{{url('productDetail/'.$products->id)}}" class="btn btn-sm btn-outline-warning"
              style="border:1px solid orange; color:gray">View Product</a>
                <a href="{{url('cart/addItem/'.$products->id)}}" class="btn btn-sm btn-outline-warning"
                style="border:1px solid orange; color:gray">Add To Cart</a>
              </div>
              <small class="text-muted">9 mins</small>
            </div>
          </div>
        </div>
      </div> 
      @empty
      <h3>No Product</h3>
      @endforelse
      
</main>

@endsection