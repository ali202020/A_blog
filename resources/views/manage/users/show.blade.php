@extends('layouts.manage')

@section('content')
  <div class="flex-container p-l-10">

    {{-- *******  Start of Flash Message  ********--}}
    @if (session('status'))
        <article class="message is-success flash-message">
          <div class="message-header msg-content is-success">
            {{ session('status') }}
          </div>
        </article>
    @endif
    {{-- *******  End of Flash Message  ********--}}

    <div class="columns m-t-10"> 

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
                <th>Actions</th>
              </tr>
            </thead>


            <tbody>
              <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at->toFormattedDateString()}}</td>
                <td>

                  <a href="{{ route('user.edit' , $user->id) }}" class="button is-outlined is-primary is-fullwidth">Edit</a>
                  <form action="{{ route('user.destroy', $user->id) }}" method="POST" role="form" style="display:hidden;">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="field">
                      <p class="control">
                        <button class="button is-outlined is-danger is-fullwidth m-t-10" >
                          Delete
                        </button>
                      </p>
                    </div>
                  </form>

                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
