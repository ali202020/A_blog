@extends('layouts.manage')

@section('content')
  <div class="flex-container p-l-10">
    {{-- *******  Start of Flash Message  ********--}}
    @if (session('success-delete'))
        <article class="message is-success flash-message">
          <div class="message-header msg-content is-success">
            {{ session('success-delete') }}
          </div>
        </article>
    @elseif(session('fail-delete'))
        <article class="message is-danger flash-message">
          <div class="message-header msg-content is-danger">
            {{ session('fail-delete') }}
          </div>
        </article>
    @endif
    {{-- *******  End of Flash Message  ********--}}
    <div class="columns m-t-10">
      <div class="column">
        <h1 class="title">Manage Users</h1>
      </div>

      <div class="column">
        <a href="{{route('users.create')}}" class="button is-primary is-rounded is-outlined is-pulled-right">Create New User<i class="fa fa-user"></i></a>
      </div>
    </div>
    <hr style="margin:0px;">

    <div class="column">
      <div class="card">
        <div class="card-content">
          <table class="table is-hoverable is-fullwidth">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date Created</th>
                <th>Role</th>
                <th>Actions</th>
              </tr>
            </thead>


            <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  {{-- <td>{{$user->created_at->toFormattedDateString()}}</td> --}}
                  <td>{{date("Y-m-d h:i:s", strtotime($user->created_at))}}</td>
                  <td>{{$user->role->name}}</td>
                  <td>

                    <a href="{{ route('users.edit' , $user->id) }}" class="button is-outlined is-primary is-small is-fullwidth">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" role="form" class="m-t-5" style="display:hidden;">
                      {{ method_field('DELETE') }}
                      {{ csrf_field() }}
                      <div class="field">
                        <p class="control">
                          <button class="button is-outlined is-danger is-small is-fullwidth">
                            Delete
                          </button>
                        </p>
                      </div>
                    </form>

                  </td>
                </tr>

              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      {{$users->links()}}
    </div>
  </div>

@endsection
