<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Mews\Purifier\Facades\Purifier;
use LaraFlash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;



class PostController extends Controller
{


    // public function __construct()
    // {
    //   $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $posts = Post::where('user_id','=',Auth::user()->id)->get();
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
        //2-Obtaining Media
        if ($request->hasFile('media')) {
          //Obtaining File Name With Extension
          $file_name_with_ext = $request->file('media')->getClientOriginalName();
          //Obtaining File Name Only
          $file_name = pathinfo($file_name_with_ext,PATHINFO_FILENAME);
          //Obtaining File Extension
          $file_ext = $request->file('media')->getClientOriginalExtension();
          //Generating New Unique Name Of the File to Be Stored In the Data Base
          $file_name_to_store = $file_name.'_'.time().'.'.$file_ext;
          //Upload File
          $path_of_stored_file = $request->file('media')->storeAs('public/media',$file_name_to_store);
        }else{
          $file_name_to_store = null;
        }
       // 3- Storing values
       $post                 = new Post();
       $post->slug           = $request->slug;
       $post->title          = $request->title;
       if ($request->has('excerpt')) {
         $post->excerpt        = $request->excerpt;
       }
       if($request->has('content')){
         $post->content        = Purifier::clean($request->content);
       }
       $post->category       = $request->category;
       $post->published_at   = Carbon::now()->toDateTimeString();
       $post->user_id        = Auth::user()->id;
       $post->media          = $file_name_to_store;


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

        $post                 = Post::where('slug','=',$slug)->first();
        //2-Obtaining Media
        if ($request->hasFile('media')) {
          //Obtaining File Name With Extension
          $file_name_with_ext = $request->file('media')->getClientOriginalName();
          //Obtaining File Name Only
          $file_name = pathinfo($file_name_with_ext,PATHINFO_FILENAME);
          //Obtaining File Extension
          $file_ext = $request->file('media')->getClientOriginalExtension();
          //Generating New Unique Name Of the File to Be Stored In the Data Base
          $file_name_to_store = $file_name.'_'.time().'.'.$file_ext;
          //Deleting Old File
          $old_file_name = $post->media;
          Storage::delete('public/media/'.$old_file_name);
          //Upload New File
          $path_of_stored_file = $request->file('media')->storeAs('public/media',$file_name_to_store);
        }
       // 3- Storing values
       if($request->hasFile('media')){
         $post->media = $file_name_to_store;
       }
       $post->slug           = $request->input('slug');
       $post->title          = $request->input('title');
       if ($request->has('excerpt')) {
         $post->excerpt        = $request->input('excerpt');
       }
       if($request->has('content')){
         $post->content        = Purifier::clean($request->input('content'));
       }
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
          //Deleting Media File If found
          if($post->media != null){
            Storage::delete('public/media/'.$post->media);
          }
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



    /**
     * Search the specified Key.
     *
     * @param  string  $search_key
     * @return \Illuminate\Http\Response
     */
    public function search($search_key)
    {
      $posts = Post::select('slug','title')->where('title','like','%'.$search_key.'%')->get();
      return json_encode($posts);
    }
}
