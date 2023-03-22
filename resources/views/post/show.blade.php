@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <div class="card mt-5">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{$post['title']}}</h5>
            <p class="card-text">Description: {{$post['description']}}</p>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <p class="card-title"><span class="fw-bold">Author:</span> {{ optional($post->user)->name ?? 'Not Found' }}</h5>
            <p class="card-text"><span class="fw-bold">Email:</span> {{optional($post->user)->email ?? 'Not Found'}}</p>
                <p class=" text-danger card-text"><span class="fw-bold">created At:</span> {{ Carbon\Carbon::parse($post->created_at)->format('l jS \\of F Y h:i:s A') }}</h5>
        </div>
    </div>
    <div>
        <div>
            <div class="card my-3">
              <div class="card-header">
                Comments
              </div>
              <div class="card-body">
                <div class="comment">
                
                    <div class="comments">
                      <p class="card-text"></p>
                    </div>
                    <hr>
                
                </div>
              </div>
            </div>
          </div>
        <div class="card mt-3">
          <div class="card-header">
            add new comment
          </div>
          <form  method="POST" action="{{route('comments.store')}}">
          <div class="card-body">
            @csrf
            <div class="mb-3">
              <label for="comment" class="form-label">Comment</label>
              <textarea class="form-control" name="comment" id="comment" ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Comment</button>
          </div></form>
        </div>
      </div>

@endsection
