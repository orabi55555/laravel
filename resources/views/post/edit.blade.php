@extends('layouts.app')


@section('title') edit @endsection

@section('content')

<form method="POST" action="{{ route('posts.update', ['id' => $post->id]) }}">
  @csrf  
  @method('PUT')
  <div class="form-group">
    <label class="mt-2">Title</label>
    <input name="title"  class="form-control" value={{$post->title}}>
    
  </div>
  <div class="form-group">
    <label class="mt-2">Description</label>
    <input name="description" class="form-control"  value="{{$post->description}}">
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


