<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Role;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role')->paginate(5);
        return view('manage.users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('manage.users.create')->withRoles($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validating Data
        $this->validate($request,[
          'name' => 'required|max:255',
          'email' => 'required|email|unique:users',
          'role' => 'required'
        ]);
        //Creating new model and storing Data

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $pass = $request->password;
        $user->password = Hash::make($pass);
        $user->api_token = bin2hex(openssl_random_pseudo_bytes(30));
        $user->role_id = $request->role;

        if ($user->save()) {
          //flash (success)
          $request->session()->flash('status', 'User Created Successfully');
          //Redirecting
          return redirect()->route('users.show',['id' => $user->id]);
        }else{
          //flash (fail)
          $request->session()->flash('status', 'Failed to Create User , Invalid Inputs');
          //Redirecting
          return redirect()->route('users.create')->with('fail','Failed To Create User');
        }
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
      $roles = Role::all();
      return view('manage.users.edit',['roles'=>$roles,'user'=>$user]);
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
        $user->role_id = $request->role;
        //saving and Redirecting
        if ($user->save()) {
          //flash (success)
           $request->session()->flash('status', 'User Updated Successfully');
           //saving and Redirecting
          return redirect()->route('users.show',$id);
        }else{
          //flash (fail)
           $request->session()->flash('status', 'Failed to Update User , Invalid Inputs');
          //saving and Redirecting
          return redirect()->route('users.edit')->with('fail','Failed to Edit User');
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
        return redirect()->route('users.index');

    }
}
