<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();


//********************
//*** User routes ****
//********************
Route::get('/user/{user}','UserController@show')->name('user.show');
Route::get('/user/{user}/edit','UserController@edit')->name('user.edit');
Route::patch('/user/{user}','UserController@update')->name('user.update');
Route::delete('/user/{user}','UserController@destroy')->name('user.destroy');
//********************



Route::prefix('manage')->group(function(){
  Route::get('/','ManageController@index')->name('manage.index');
  Route::get('/dashboard','ManageController@dashboard')->name('manage.dashboard');

  //********************
  //*** Posts routes ***
  //********************
  Route::resource('/posts','PostController');
});

Route::get('/home', 'HomeController@index')->name('home');
