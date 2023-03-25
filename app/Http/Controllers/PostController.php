<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\File;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function index()
    {  $posts = Post::with('user')->paginate(4);
        return view('post.index',['posts' => $posts]);
        return view('post.index', ['posts' => $allPosts,'users'=> $users]);
    }

    public function show($id)
    {$post = Post::with('user')->find($id);
        $comments = $post->comments;
        
        return view('post.show',['post'=>$post,'comments'=>$comments]);
    }


    public function create()
    {
        $users= User::all();

        return view('post.create',['users'=> $users]);
    }
    public function store(StorePostRequest $request)
    {   
        $image = $request->file('image')->store('images',['disk' => "public"]);
        
        
        $post=Post::create([
            'title'=>request()->title,
            'description'=>request()->description,
            'user_id' => request()->post_creator,
            'image' =>$image,
            
        ]);
        $tags = explode(",", $request->tags);
        $post->tags=$tags;
        $post->syncTags($tags);
        return redirect()->route('posts.index');
    }


    public function edit($id)
    {

        $post = Post::find($id);
       
        $users = User::all();


        return view('post.edit', ['post' => $post, 'users'=>$users]);

        
    }
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->description =$request->input('description');
        $post->user_id = $request->input('post_creator');
        $tags=explode(",", $request->input('tags'));
        $post->syncTags($tags);
        
        if($request->hasFile("image")){

            Storage::disk("public")->delete($post->image);
      
            $image = $request->file('image')->store('images',['disk' => "public"]);
            $post->image=$image;
      
          }
        $post->update();
    
        // $updatedPost = Post::with('user')->find($id);     
      
        return redirect()->route('posts.index')
                         ->with('success', 'Post updated successfully.');
        
        
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->comments()->delete();
        Storage::disk("public")->delete($post->image);
        $post->delete();

        return redirect()->route('posts.index')
                         ->with('success', 'Post deleted successfully.');
    }

    
}

