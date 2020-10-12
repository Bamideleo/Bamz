@extends('front.layout')
@section('title','Categories page')
@section('content')
<main role="main" class="col-md-8 ml-sm-auto col-lg-10 px-4">
<div class="album py-5 bg-light">
  <div class="container">
  <?$cate=DB::table('categories')->select('name')->where('id',$cat)->get()?>
  <h4 style="color:orange">Category:
  @foreach($cate as $ca)
  <span style="color:gray;">{{$ca->name}}</span></h4>
   @endforeach
  <br> 
    <div class="row">
    @foreach($category as $products)
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm" style="border:1px solid orange">
        <center>
          <img class="card-img-top" src="{{asset('/storage/images/'.$products->image)}}" alt="image" id="card">
          </center>
          <div class="card-body">
          <del style="color:red"><span>&#8358;</span> {{$products->pro_price}}</del>
          <span class="price text-muted float-right">&#8358; {{$products->ship_price}} </span>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
             <a href="{{url('productDetail/'.$products->id)}}" class="btn btn-sm btn-outline-warning"
            style="border:1px solid orange;color:gray" >View Product</a>
             <a href="{{url('cart/addItem/'.$products->id)}}" class="btn btn-sm btn-outline-warning"
             style="border:1px solid orange; color:gray">Add To Cart</a>
              </div>
              <small class="text-muted">9 mins</small>
            </div>
          </div>
        </div>
      </div> 
      @endforeach
<br>
  <div class="card-header" style="color:orange; margin-top:20px; margin-bottom:20px;">
  WE FOUND OTHER PRODUCTS YOU MIGHT LIKE!
  </div>
 <br> 
<div class="row">
@foreach($foundPro as $found)
    <div class="col-md-3">
    <div class="card mb-4 shadow-sm" style="border:1px solid orange; padding-bottom:20px; padding-right:10px;
    padding-left:10px">
      <center>
        <a href="{{url('productDetail/'.$found->id)}}">
          <img class="card-img-top" src="{{asset('/storage/images/'.$found->image)}}" alt="image" id="card">
        </a>
          </center>
    </div>
  </div>
  @endforeach
</div>
</main>

@endsection