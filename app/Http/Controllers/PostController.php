<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {  $posts = Post::with('user')->paginate(4);
        return view('post.index',['posts' => $posts]);
        // dd($allPosts);
        // [
        //     [
        //         'id' => 1,
        //         'title' => 'Laravel',
        //         'posted_by' => 'Ahmed',
        //         'created_at' => '2022-08-01 10:00:00'
        //     ],

        //     [
        //         'id' => 2,
        //         'title' => 'PHP',
        //         'posted_by' => 'Mohamed',
        //         'created_at' => '2022-08-01 10:00:00'
        //     ],

        //     [
        //         'id' => 3,
        //         'title' => 'Javascript',
        //         'posted_by' => 'Ali',
        //         'created_at' => '2022-08-01 10:00:00'
        //     ],
        // ];


        return view('post.index', ['posts' => $allPosts,'users'=> $users]);
    }

    public function show($id)
    {$post = Post::with('user')->find($id);
        return view('post.show', compact('post'));
    }


    public function create()
    {
        $users= User::all();

        return view('post.create',['users'=> $users]);
    }
    public function store(Request $request)
    {
        $data= $request->all();
        $title= request()->title;
        $description= request()->description;
        $postCreator= request()->post_creator;
        Post::create([
            'title'=>$title,
            'description'=>$description,
            'user_id' => $postCreator,
        ]);
        return redirect()->route('posts.index');
    }


    public function edit($id)
    {

        $post = Post::find($id);
        $users = User::all();


        return view('post.edit', ['post' => $post, 'users'=>$users]);

        
    }
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->description =$request->input('description');
        $post->user_id = $request->input('post_creator');
        $post->update();
    
        // $updatedPost = Post::with('user')->find($id);     
      
        return redirect()->route('posts.index')
                         ->with('success', 'Post updated successfully.');
        
        
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('posts.index')
                         ->with('success', 'Post deleted successfully.');
    }

    
}

