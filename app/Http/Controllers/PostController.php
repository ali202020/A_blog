<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Mews\Purifier\Facades\Purifier;
use LaraFlash;
use Illuminate\Support\Facades\Session;



class PostController extends Controller
{


    public function __construct()
    {
      $this->middleware('role:superadministrator|adminstrator|author|contributor|editor');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $posts = Post::where('post_writer_id','=',Auth::user()->id)->get();
      //return json_encode($posts);
      return view('manage.posts.index')->withPosts($posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1- validating Data :
          //**postboned
       // 2- Storing values
       $post                 = new Post();
       $post->slug           = $request->slug;
       $post->title          = $request->title;
       $post->excerpt        = $request->excerpt;
       $post->content        = Purifier::clean($request->content);
       $post->published_at   = Carbon::now()->toDateTimeString();
       $post->post_writer_id = Auth::user()->id;
       if($post->save()){
         //flash (success)
         $request->session()->flash('status', 'Post Created Successfully');
         //Redirect to show page
         return redirect()->route('posts.show',['slug'=>$request->slug]);
       }else{
         //flash (fail)
         $request->session()->flash('status', 'Failed to Create Post , Invalid Inputs');
         //Redirect to show page
         return redirect()->route('posts.create');

       }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      $post = Post::where('slug','=',$slug)->first();
      return view('manage.posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
      $post = Post::where('slug','=',$slug)->first();
      return view('manage.posts.edit')->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        // 1- validating Data :
          //**postboned
       // 2- Storing values
       $post                 = Post::where('slug','=',$slug)->first();
       $post->slug           = $request->input('slug');
       $post->title          = $request->input('title');
       $post->excerpt        = $request->input('excerpt');
       $post->content        = Purifier::clean($request->input('content'));
       if($post->save()){
         //flash (success)
          $request->session()->flash('status', 'Post Updated Successfully');
         //Redirect to show page
         return redirect()->route('posts.show',['slug'=>$request->slug]);
       }else{
         //flash (fail)
          $request->session()->flash('status', 'Failed to Update Post , Invalid Inputs');
         //Redirect to show page
         return redirect()->route('posts.edit',['slug'=>$request->slug]);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        if(Post::where('slug','=',$slug)->first()->exists()){
          $post = Post::where('slug','=',$slug)->first();
          $post->delete();
          //flash success
          Session::flash('success-delete', 'Record Deleted Successfully');
        }else{
          Session::flash('fail-delete', 'Failed to Delete Record');
        }
        //At Both cases redirect to index page
        return redirect()->route('posts.index');
    }

    /*
    * This function is to check Uniqueness Of The Generated Slug
    */

    public function apiCheckUnique(Request $request){

      //will send slug as a routing parameter
       return json_encode(Post::where('slug','=',$request->slug)->exists()); //this will return true or false..true if exists ,,false if not exists

    }
}
