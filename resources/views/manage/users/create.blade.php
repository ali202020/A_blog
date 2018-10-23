@extends('layouts.manage')
@section('content')
  <div class="container">
    <div class="columns">
      <div class="column is-half is-offset-one-quarter m-t-75">
        <div class="card">
          <div class="card-content">

            {{-- *******  Start of Flash Message  ********--}}
            @if (session('status'))
                <article class="message is-danger flash-message">
                  <div class="message-header msg-content is-danger">
                    {{ session('status') }}
                  </div>
                </article>
            @endif
            {{-- *******  End of Flash Message  ********--}}

            <h1 class="title">Create New User</h1>
            <hr>
            <form action="{{ route('users.store') }}" method="POST" role="form">
              {{ csrf_field() }}

              <div class="field">
                <label class="label">Name : </label>
                <p class="control has-icons-left has-icons-right">
                  <input id="name" class="input {{ $errors->has('name') ? ' is-danger ' : '' }}" type="text" placeholder="Name" name="name" value="{{ old('name') }}" required autofocus>
                  <span class="icon is-small is-left">
                    <i class="fa fa-user"></i>
                  </span>
                </p>
                @if ($errors->has('name'))
                    <p class="help is-danger">{{ $errors->first('name') }}</p>
                @endif
              </div>

              <div class="field">
                <label class="label">Email Address : </label>
                <p class="control has-icons-left has-icons-right">
                  <input id="email" class="input {{ $errors->has('email') ? ' is-danger ' : '' }}" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                  <span class="icon is-small is-left">
                    <i class="fa fa-envelope"></i>
                  </span>
                </p>
                @if ($errors->has('email'))
                    <p class="help is-danger">{{ $errors->first('email') }}</p>
                @endif
              </div>

              <div class="field">
                <label class="label {{ $errors->has('password') ? ' is-danger ' : '' }}">Password : </label>
                <p class="control has-icons-left">
                  <input id="password" class="input" type="password" placeholder="Password" required>
                  <span class="icon is-small is-left">
                    <i class="fa fa-lock"></i>
                  </span>
                </p>
                @if ($errors->has('password'))
                    <p class="help is-danger">{{ $errors->first('password') }}</p>
                @endif
              </div>

              <div class="field">
                <div class="control">
                  <label class="label">Role : </label>
                  <div class="select is-primary">
                    <select name="role">
                      @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>



              <div class="field m-t-50">
                <p class="control">
                  <button class="button is-fullwidth is-success">
                    Create New User
                  </button>
                </p>
              </div>
            </form>
          </div>  <!-- End Of Card Content -->
        </div> <!--End Of Card-->

      </div>
    </div>
  </div>


@endsection
