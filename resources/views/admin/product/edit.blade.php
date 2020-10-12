@extends('admin.layout')
@section('title','Edit Products')
@section('content')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" >
<h3 style="text-decoration:underline">Edit Product</h3>
<div class="col-md-6">
<div class="panel-body">
<form action="{{route('dit.update',$dit->id)}}" method="post">
@csrf
<div class="form-group">
    <label for="formGroupExampleInput">Product Name</label>
    <input type="text" class="form-control" id="pname" name="pro_name" value="{{$dit->pro_name}}">
    <label for="formGroupExampleInput">Product Code</label>
    <input type="number" class="form-control" id="pcode" name="pro_code" value="{{$dit->pro_code}}">
    <label for="formGroupExampleInput">Product Price</label>
    <input type="number" class="form-control" id="price"  name="pro_price" value="{{$dit->pro_price}}">
    <label for="formGroupExampleInput">Product Info</label>
    <input type="text" class="form-control" id="price"  name="pro_info" value="{{$dit->pro_info}}">
    <label for="formGroupExampleInput">Shipping Price</label>
    <input type="number" name="ship_price" class="form-control" id="ship_price" value="{{$dit->ship_price}}">
    <br>
    <input type="submit" value="Update">
  </div>
</form>
</div>
</div>

@endsection