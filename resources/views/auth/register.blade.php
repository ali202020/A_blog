@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="columns">
      <div class="column is-half is-offset-one-quarter m-t-75">
        <div class="card">
          <div class="card-content">
            <h1 class="title">Register</h1>
            <hr>
            <form action="{{ route('register') }}" method="POST" role="form">
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
                <label class="label {{ $errors->has('password_confirmation') ? ' is-danger ' : '' }}"> Confirm Password : </label>
                <p class="control has-icons-left">
                  <input id="password-confirm" name="password_confirmation" class="input" type="password" placeholder="Password confirmation" required>
                  <span class="icon is-small is-left">
                    <i class="fa fa-lock"></i>
                  </span>
                </p>
                @if ($errors->has('password_confirmation'))
                    <p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
                @endif
              </div>





              <div class="field m-t-50">
                <p class="control">
                  <button class="button is-fullwidth is-outlined is-primary">
                    Register
                  </button>
                </p>
              </div>
            </form>
          </div>  <!-- End Of Card Content -->
        </div> <!--End Of Card-->

        <h5 class="has-text-centered m-t-20">
          <a class="btn btn-link is-muted" href="{{ route('login') }}">
              Already have account?
          </a>
        </h5>
      </div>
    </div>
  </div>

{{--
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                         --}}
@endsection
