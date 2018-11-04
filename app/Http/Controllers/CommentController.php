<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Auth;
use App\Events\NewComment;


class CommentController extends Controller
{


    // //Adding 'Auth' middleware
    // public function __construct()
    // {
    //   $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
      //Obtaining all the comments specified for a specific post
      $post = Post::findOrFail($id);
      return response()->json($post->comments()->with('user')->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store($id , Request $request)
     {
       $post = Post::findOrFail($id);
       $comment = $post->comments()->create([
         'body' => $request->body,
         'user_id' => Auth::id()
       ]);

       //But we want to return User information along with the stored comment,
       // so we will eagerload user along with the new stored comment
       $comment = Comment::where('id',$comment->id)->with('user')->first();

       //Trigering the event : broadcast( event instance)->toOthers
       broadcast(new NewComment($comment))->toOthers();
       

       //returning result to axios to be handled by vue in order to be displayed in the view
       return $comment->toJson();
     }


}
