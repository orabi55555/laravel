@extends('layouts.app')


@section('title') edit @endsection

@section('content')

<form method="POST" action="{{route('posts.store')}}">
  @csrf  
  <div class="form-group">
    <label class="mt-2">Title</label>
    <input  class="form-control" value=<?php echo $post['title']?>></input>
    
  </div>
  <div class="form-group">
    <label class="mt-2">Description</label>
    <input class="form-control"  value=<?php echo $post['description']?>>
  </div>
  <div class="form-group ">
  <label class="mt-2">Post Creator</label>
    <input class="form-control"  value="{{$post['posted_by']}}">
  </div>
  
  <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>
@endsection


