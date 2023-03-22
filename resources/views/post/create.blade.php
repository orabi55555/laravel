@extends('layouts.app')


@section('title') create @endsection

@section('content')
<form method="POST" action="{{route('posts.store')}}">
@csrf 
  <div class="form-group">
    <label class="mt-2">Title</label>
    <input  class="form-control" name="title" placeholder="Enter the title"/>
    
  </div>
  <div class="form-group">
    <label class="mt-2">Description</label>
    <textarea class="form-control" name="description"   placeholder="Enter the description"></textarea>
  </div>
  <div class="form-group ">
  <label class="mt-2">Post Creator</label>
  
    <select name="post_creator" class="form-control">
      @foreach ($users as $user)
  <option value="{{$user->id}}" >{{$user->name}}</option>
  @endforeach
      
    </select>
  </div>
  <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>
@endsection


