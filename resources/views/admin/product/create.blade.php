@extends('admin.layout')
@section('title','Insert Products')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" >
<h3 style="text-decoration:underline">Add New Product</h3>
@if(session()->has('message'))
<div class="alert alert-success">{{session()->get('message')}}</div>
@elseif(session()->has('error'))
<div class="alert alert-danger">{{session()->get('error')}}</div>
@endif
<br>
<div class="col-md-6">
<div class="panel-body">
<form action="/admin/create" method="POST" enctype="multipart/form-data" >
@csrf
<div class="form-group">
    <label for="formGroupExampleInput">Product Name</label>
    <span class="text-danger" style="font-size:12">{{$errors->first('pro_name')}}</span>
    <input type="text" class="form-control" id="pname" name="pro_name" placeholder="Product Name">
    <label for="formGroupExampleInput">Product Code</label>
    <span class="text-danger" style="font-size:12">{{$errors->first('pro_code')}}</span>
    <input type="text" class="form-control" id="pcode" name="pro_code" placeholder="Product Code">
    <label for="formGroupExampleInput">Product Price</label>
    <span class="text-danger" style="font-size:12">{{$errors->first('pro_price')}}</span>
    <input type="text" class="form-control" id="price"  name="pro_price" placeholder="Product Price">
    <label for="formGroupExampleInput">Product Info</label>
    <span class="text-danger" style="font-size:12">{{$errors->first('pro_info')}}</span>
    <textarea name="pro_info" id="info" class="form-control"></textarea>
    <label for="formGroupExampleInput">Stock</label>
    <span class="text-danger" style="font-size:12">{{$errors->first('stock')}}</span>
    <input type="text" class="form-control" id="stock"  name="stock" placeholder="Stock">
    <label for="formGroupExampleInput"></label>
    <span class="text-danger" style="font-size:12">{{$errors->first('categories')}}</span>
    <select name="categories" class="form-control">
  <option selected disabled>Select Categories</option>
  @foreach($brand as $brands)
  <option value="{{$brands->id}}">{{$brands->name}}</option>
  @endforeach
    </select>
    <label for="formGroupExampleInput">Shipping Price</label>
    <span class="text-danger" style="font-size:12">{{$errors->first('ship_price')}}</span>
    <input type="text" name="ship_price" class="form-control" id="ship_price" placeholder="Shipping Price">
    <label for="formGroupExampleInput">Upload Image</label>
    <span class="text-danger" style="font-size:12">{{$errors->first('image')}}</span>
    <input type="file" name="image" class="form-control" id="ship_price" >
    <br>
    <input type="submit" value="Save" class="btn btn-sm btn-primary" >
  </div>
</form>
</div>
</div>
</main>
@endsection