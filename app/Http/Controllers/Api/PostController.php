<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
       $allPosts=Post::all();
       return PostResource::collection($allPosts);
    //    $response=[];
    //    foreach($allPosts as $post){
    //     $response []=[
    //         'id'=>$post->id,
    //         'title'=>$post->title,
    //         'description'=>$post->description,
    //     ];
    //    }
    //    return $response;
    }
    public function show($id)
    {$post = Post::find($id);

    return new PostResource($post);}
    public function store(StorePostRequest $request)
    {    
        $post=Post::create([
            'title'=>request()->title,
            'description'=>request()->description,
            'user_id' => request()->post_creator,
            
            
        ]);
        $tags = explode(",", $request->tags);
        $post->tags=$tags;
        $post->syncTags($tags);
        return new PostResource($post);
    //     return [
    //         'id'=>$post->id,
    //         'title'=>$post->title,
    //         'description'=>$post->description,];
    
    }

}
