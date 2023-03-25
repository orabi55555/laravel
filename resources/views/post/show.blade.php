@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <div class="card m-3">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{$post['title']}}</h5>
            <p class="card-text">Description: {{$post['description']}}</p>
            {{-- <img src="{{asset($post->image)}}"> --}}
            {{-- @dd(Storage::url($post->image),$post->image,asset($post->image)); --}}
            @if($post->image !=null)
            <img src="{{'/'.'storage/'.$post->image}}" width="250" alt=""/>
            @endif
        </div>
    </div>

    <div class="card m-3">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <p class="card-title"><span class="fw-bold">Author:</span> {{ optional($post->user)->name ?? 'Not Found' }}</h5>
             
              <p class="card-title"><span class="fw-bold">Tags:
                @foreach($post->tags as $tag)
                </span> {{$tag->name }}</h5>
                @endforeach
            <p class="card-text"><span class="fw-bold">Email:</span> {{optional($post->user)->email ?? 'Not Found'}}</p>
                <p class=" text-danger card-text"><span class="fw-bold">created At:</span> {{ $post->created_at->format('l jS \\of F Y h:i:s A') }}</h5>
        </div>
    </div>
    <div>
     
      <div class="card m-3">
        <div class="card-header">
          Comments
        </div>
        <div class="card-body">
          <div class="comments">
            @foreach ($post->comments as $comment)
            <div class="comment d-flex ">
            <p class="card-text">{{$comment->comment}}</p>
            <form class="mx-5" action="{{ route('comments.destroy', $comment->id) }}" method="POST">
              @csrf
              @method('DELETE')

            {{-- <x-button type="primary"  :link="route('comments.edit',$post['id'],'edit')" >edit</x-button> --}}
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this comment?')">delete</button>
           </form>
            </div>
            <hr>
            
            @endforeach
            
            
            
          </div>
        </div>
      </div>
      
          
        <div class="card m-3">
          <div class="card-header">
            add new comment
          </div>
          <form  method="POST" action="{{route('comments.store')}}">
          <div class="card-body">
            @csrf
            <div class="mb-3">
              <label for="body" class="form-label">Comment</label>
              <textarea class="form-control" name="body" id="comment" required></textarea>
            </div>
            <input type="hidden" name="commentable_id" value="{{ $post->id }}">
            <input type="hidden" name="commentable_type" value="{{ get_class($post) }}">
            <button type="submit" class="btn btn-primary">Add Comment</button>
          </div></form>
        </div>
      </div>
      
@endsection
