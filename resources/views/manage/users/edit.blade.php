@extends('layouts.manage')

@section('content')
  <div class="flex-container p-l-10">
    <div class="columns m-t-10">
      {{-- *******  Start of Flash Message  ********--}}
      @if (session('status'))
          <article class="message is-danger flash-message">
            <div class="message-header msg-content is-danger">
              {{ session('status') }}
            </div>
          </article>
      @endif
      {{-- *******  End of Flash Message  ********--}}

      <div class="column">
        <h1 class="title">Manage Users</h1>
      </div>

      <div class="column">
        <a href="{{route('users.create')}}" class="button is-primary is-rounded is-outlined is-pulled-right">Create New User<i class="fa fa-user"></i></a>
      </div>
    </div>
    <hr style="margin:0px;">

    <form action="{{ route('users.update', $user->id) }}" method="POST" role="form">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
      <div class="column">
        <div class="card">
          <div class="card-content">
            <table class="table is-hoverable is-fullwidth">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>New Password</th>
                  <th>Role</th>
                  <th>Actions</th>
                </tr>
              </thead>


              <tbody>
                <tr>
                  <td>{{$user->id}}</td>
                  <td>
                    <input id="name" class="input" type="text" name="name" value="{{ $user->name }}" autofocus>
                  </td>
                  <td>
                    <input id="email" class="input" type="email" name="email" value="{{ $user->email }}" autofocus>
                  </td>
                  <td>
                    <input id="password" class="input" type="password" name="password" placeholder="New Password" autofocus>
                    <p class="help is-success">Keep this field empty if you don't want to change password</p>
                  </td>

                  <td>
                    <div class="select is-primary">
                      <select name="role">
                        @foreach ($roles as $role)
                          <option value="{{ $role->id }}" @if($role->id == $user->role->id) {{"selected"}}@endif }}>{{ $role->display_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </td>

                  <td>

                    <div class="field">
                      <p class="control">
                        <button class="button is-outlined is-primary is-fullwidth">
                          Save Changes
                        </button>
                      </p>
                    </div>
                    </form>

                    {{-- this is Deletion form --}}
                    <form method="POST" id="Delete-form" action="{{ route('users.destroy', ['id' => $user->id]) }}" role="form" style="display: hidden;">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <div class="field">
                        <p class="control">
                          <button class="button is-outlined is-primary is-fullwidth">
                            Delete
                          </button>
                        </p>
                      </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </form>
  </div>

@endsection
