@extends('admin.layout')
@section('title','Categoies Page')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
<h3>ADD PRODUCT</h3>
<div class="table-responsive">
<form action="{{'/admin/categories'}}" method="post">
        @csrf
        <div>
        <label for="formGroupExampleInput">Categories</label>
        <span class="text-danger" style="font-size:12">{{$errors->first('name')}}</span>
    <input type="text" class="form-control" id="categories" name="name" placeholder="Categories"
     style="width:50%;">
    <br>
        <input type="submit" class="btn btn-sm btn-primary" value="Add Brand" >
        </div>
        </form>
        <br>
<table class="table table-hover">
<thead>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($brand as $brands)
        <tr>
        <td>{{$brands->id}}</td>
        <td>{{$brands->name}}</td>
        <td>
        <form action="{{'/admin/categories/'.$brands->id.'/destroy'}}" method="post">
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