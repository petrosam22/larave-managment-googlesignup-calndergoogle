
@extends('home')


@section('content')

<form method="POST" action="{{route('store')}}">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Name</label>
      <input type="text"  name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Description</label>
      <input type="text" name="description" class="form-control" id="exampleInputPassword1">
    </div>
     
    <button type="submit" class="btn btn-primary">create</button>
  </form>
  
  
  
  @endsection