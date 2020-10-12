@extends('admin.layout')
@section('title','List Products')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
<h3>Products</h3>
<div class="table-responsive">
<table class="table table-hover">
<thead>
        <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Brand No</th>
        <th>Details</th>
        <th>Normal Price</th>
        <th>Edit</th>
        <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($product as $products)
        <tr>
        <td><img src="{{asset('/storage/images/'.$products->image)}}" alt="image" width="60"></td>
        <td>{{$products->pro_name}}</td>
        <td>{{$products->pro_price}}</td>
        <td>{{$products->pro_code}}</td>
        <td>{{$products->pro_info}}</td>
        <td>{{$products->ship_price}}</td>
        <td><a href="{{'/admin/'.$products->id.'/edit'}}" class="btn btn-sm btn-secondary" >Edit</a></td>
        <td>
        <form action="{{'/admin/'.$products->id.'/destroy'}}" method="post">
        @csrf
        @method('delete')
        <input type="submit" class="btn btn-sm btn-danger" value="Delete" >
        </form>
        </td>
        </tr>
        @endforeach
        </tbody>
        </table>
        
</div>
</main>
@endsection