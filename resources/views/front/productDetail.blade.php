@extends('front.layout')
@section('title','Details Page')
@section('content')
<br><br>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="container">
        <div class="row" style="color:gray">
            @foreach($details as $dat)
            <div class="col-md-6 col-xs-12">
            <div class="thumbnail">
            <img class="card-img-top" src="{{asset('/storage/images/'.$dat->image)}}" alt="image">
            </div>
            </div>
                <div class="col-md-5 col-md-offset-1">
                <h2><?echo ucwords($dat->pro_name)?></h2>
                <h5>{{$dat->pro_info}}</h5>
                <h2 class="text-danger"><span>&#8358;</span> {{$dat->ship_price}}</h2>
                <p><b>Available: {{$dat->stock}} in stock</b></p>
                <a href="{{url('cart/addItem/'.$dat->id)}}" class="btn btn-sm btn-outline-warning"
                style="border:1px solid orange; color:gray">Add To Cart</a>
                <br><br>
                <?php  
                $wishlistData = DB::table('wishlist_')->rightjoin('products','wishlist_.pro_id','=','products.id')
                ->where('wishlist_.pro_id','=',$dat->id)->get();
                $count = App\wishlist_model::where(['pro_id'=>$dat->id])->count();
                if($count=="0"){
                ?>
                <form action="{{route('addWishlist')}}" method="post">
                @csrf
                <input type="hidden" name="pro_id" value="{{$dat->id}}">
                <button class="btn btn-sm btn-outline-warning" style="border:1px solid orange; color:gray">
                Add to wishlist</button>
                </form>
                <?php } else{?>
                <h6 style="color:orange">Already Added to wishlist<a href="{{url('wishlist')}}"> Wishlist</a></h6>
                <?php }?>
        </div>
        @endforeach
        </div>
        </div>
        <br>
  <div class="card-header" style="color:orange;">
  WE FOUND OTHER PRODUCTS YOU MIGHT LIKE!
  </div>
 <br> 
<div class="row">
@foreach($foundPro as $found)
  <div class="col-sm-4">
    <div class="card">
    <div class="card mb-4 shadow-sm" style="border:1px solid orange; padding-bottom:20px">
      <center>
        <a href="{{url('productDetail/'.$found->id)}}">
          <img class="card-img-top" src="{{asset('/storage/images/'.$found->image)}}" alt="image" id="card">
          </a>
          </center>
      </div>
    </div>
  </div>
  @endforeach
</div>
<br><br>
</main>
@endsection