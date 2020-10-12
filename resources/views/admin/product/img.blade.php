@extends('admin.layout')
@section('title','Insert Image')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" >
<h3 style="text-decoration:underline">Add New Image</h3>
<form action="{{'/admin/'.$dit->id.'/upload'}}" method="POST" enctype="multipart/form-data">
<div>
@csrf
<input type="file" name="image" class="" id="image">
<input type="submit"  class="btn btn btn-primary" id="upload" value="Upload" >
</div>
    </form>
    </main>
@endsection