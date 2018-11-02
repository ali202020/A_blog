<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Post;

class ManageController extends Controller
{

    public function dashboard()
    {
      $posts = Post::where('user_id','=',Auth::user()->id)->get();
      return view('manage.dashboard')->withPosts($posts);
    }

    public function index()
    {
      return redirect()->route('manage.dashboard');

    }

}
