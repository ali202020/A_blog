<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>A_Blog</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar has-shadow is-white" role="navigation" aria-label="main navigation">
          <div class="container">

            <div class="navbar-brand">
              <a class="navbar-item" href="{{route('home')}}">
                <img src="{{ asset('images/final.png') }}" alt="Elshazly_logo">
              </a>
              <a href="#" class="navbar-item is-tab is-hidden-mobile m-l-10">Learn</a>
              <a href="#" class="navbar-item is-tab is-hidden-mobile">Discuss</a>
              <a href="#" class="navbar-item is-tab is-hidden-mobile">Share</a>
            </div>

            <div class="navbar-menu">
              @if(Auth::guest())
                <div class="navbar-end">
                  <a href="{{ route('login') }}" class="navbar-item is-tab">Login</a>
                  <a href="{{ route('register') }}" class="navbar-item is-tab">SignUp</a>
                </div>
              @else

                <div class="navbar-end navbar-item has-dropdown is-hoverable is-right">
                  <a class="navbar-link" href="#">
                    Hi Ali!
                  </a>

                  <div class="navbar-dropdown">
                    <a class="navbar-item" href="#">
                      <span class="icon"><i class="fa fa-user-circle"></i></span>
                         Profile
                    </a>
                    <a class="navbar-item" href="#">
                      <span class="icon"><i class="fa fa-bell"></i></span>
                       Notifications
                    </a>
                    <a class="navbar-item" href="{{route('manage.dashboard')}}">
                      <span class="icon"><i class="fa fa-cog"></i></span>
                         Manage
                    </a>
                    <hr class="navbar-divider">

                    <a class="navbar-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <span class="icon"><i class="fa fa-sign-out"></i></span>
                       Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                  </div>
                </div>

              @endif


            </div>

          </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- @include('_includes.notifications.toast') --}}
    @yield('scripts')
</body>
</html>
