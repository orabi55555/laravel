@extends('layouts.app')


@section('title') create @endsection

@section('content')
<form method="POST" action="{{route('posts.store')}}">
@csrf 
  <div class="form-group">
    <label class="mt-2">Title</label>
    <input  class="form-control" placeholder="Enter the title"></input>
    
  </div>
  <div class="form-group">
    <label class="mt-2">Description</label>
    <input class="form-control"   placeholder="Enter the description">
  </div>
  <div class="form-group ">
  <label class="mt-2">Post Creator</label>
    <input class="form-control"   placeholder="Enter the creator name">
  </div>
  <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>
@endsection


