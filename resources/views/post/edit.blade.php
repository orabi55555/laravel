@extends('layouts.app')


@section('title') edit @endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger m-5">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" class="m-3" action="{{ route('posts.update', ['id' => $post->id]) }}" enctype="multipart/form-data">
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
  @if($post->image !=null)
  <div class="form-group">
    <label for="user" class="form-label">Image</label>
   
    <input class="form-control" name="image" type="file" id="formFile" >
    <img class="mt-2" src="{{'/'.'storage/'.$post->image}}" width="250" alt=""/>
  </div>
  @endif
  @php
$newtags=array();
 for($i=0;$i<count($post->tags);$i++){
array_push($newtags,$post->tags[$i]['name']);
}
   
  @endphp 
  <div class="form-group">
    <label for="user" class="form-label">Tags</label>
    <input class="form-control" name="tags"  id="formFile" value="{{implode(',',$newtags)}}">
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


