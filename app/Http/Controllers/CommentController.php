<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    //
    
    public function store(Request $request)
    {
     

    Comment::create([
        'comment'=> $request->body,
        'commentable_type'=> $request->commentable_type,
        'commentable_id' => $request->commentable_id,
    ]);
    return redirect()->back();
    }

    // public function edit(Request $request, $id)
    // {
    //     $comment = Comment::findOrFail($id);
    //     $comment->body = $request->body;
    //     $comment->save();
    //     return back()->with('success','comment updated successfully!');
    // }


    public function destroy($id)
    {  
        $comment = Comment::find($id)->delete();

        return redirect()->back();
    }
}
