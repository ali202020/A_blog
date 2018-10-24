<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    //Adding 'Auth' middleware
    public function __construct()
    {
      $this->middleware('auth');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('manage.users.show')->with('user',$user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = User::findOrFail($id);
      return view('manage.users.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validating Data
        // $this->validate($request,[
        //   'name' => 'required|max:255',
        //   'email' => 'required|email|unique:users,email,'.$id
        // ]);

        //Updating Data
        $user = User::findOrFail($id);

        if ($request->has('name')) {
          $user->name = $request->name;
        }

        if ($request->has('email')) {
          $user->email = $request->email;
        }

        if ($request->has('password')) {
          $user->name = $request->name;
          $user->email = $request->email;
          $user->password = Hash::make($request->password);
        }

        //saving and Redirecting
        if ($user->save()) {
          //flash (success)
           $request->session()->flash('status', 'Your profile Updated Successfully');
           //saving and Redirecting
          return redirect()->route('user.show',$id);
        }else{
          //flash (fail)
           $request->session()->flash('status', 'Failed to Update Your profile , Invalid Inputs');
          //saving and Redirecting
          return redirect()->route('user.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Deleting Data
        DB::table('users')->where('id',$id)->delete();
        //flash success
        Session::flash('success-delete', 'Record Deleted Successfully');
        //Redirecting
        return redirect()->back();

    }
}
