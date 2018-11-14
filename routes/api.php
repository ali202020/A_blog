<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('posts/{post}/comments','CommentController@index');
Route::get('posts/{search_key}','PostController@search');

Route::middleware('auth:api')->group(function(){
  Route::get('/user', function (Request $request) {
      return $request->user();
  });
  Route::get('/posts/unique','PostController@apiCheckUnique')->name('api.slug.unique');
  Route::post('posts/{post}/comment','CommentController@store');

});
