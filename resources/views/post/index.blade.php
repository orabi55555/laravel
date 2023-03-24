@extends('layouts.app')


@section('title') Index @endsection

@section('content')
    <div class="text-center">
        <a  href="{{route('posts.create')}}"  class="mt-4 btn btn-success">Create Post</a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
      
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{date('Y-m-d', strtotime($post->created_at))}}</td>
                <td>
                    <!-- <a href="{{route('posts.show', $post->id)}}" class="btn btn-info">View</a>
                    <a href="{{route('posts.edit', $post->id,'edit')}}" class="btn btn-primary">Edit</a>
                    <a href="#" class="btn btn-danger">Delete</a>
                 
                     -->
                     <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                     <x-button type="info" :link="route('posts.show',$post['id'])" >view</x-button>
                      <x-button type="primary" :link="route('posts.edit',$post['id'],'edit')" >edit</x-button>
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">delete</button>
                     </form>
                </td>
            </tr>
        @endforeach



        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $posts->links('pagination::bootstrap-5') !!}
    </div>
@endsection


 