@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="columns">
      <div class="column is-half is-offset-one-quarter m-t-75">
        <div class="card">
          <div class="card-content">
            <h1 class="title">Login</h1>
            <hr>
            <form action="{{ route('login') }}" method="POST" role="form">
              {{ csrf_field() }}
              <div class="field">
                <label class="label">Email Address : </label>
                <p class="control has-icons-left has-icons-right">
                  <input class="input {{ $errors->has('email') ? ' is-danger ' : '' }}" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
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
                  <input class="input" type="password" placeholder="Password" required>
                  <span class="icon is-small is-left">
                    <i class="fa fa-lock"></i>
                  </span>
                </p>
                @if ($errors->has('password'))
                    <p class="help is-danger">{{ $errors->first('password') }}</p>
                @endif
              </div>


              <b-checkbox v-model="checkboxGroup" native-value="Remember Me" class="is-success m-t-20" {{ old('remember') ? 'checked' : '' }}>
                  Remember Me
              </b-checkbox>


              <div class="field m-t-30">
                <p class="control">
                  <button class="button is-fullwidth is-outlined is-primary">
                    Login
                  </button>
                </p>
              </div>
            </form>
          </div>  <!-- End Of Card Content -->

        </div> <!--End Of Card-->
        <h5 class="has-text-centered m-t-20">
          <a class="btn btn-link is-muted" href="{{ route('password.request') }}">
              Forgot Your Password?
          </a>
        </h5>
      </div>
    </div>
  </div>

@endsection
