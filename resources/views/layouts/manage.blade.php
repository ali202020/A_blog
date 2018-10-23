<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>A_Blog - Manage</title>

    {{-- Tiny Mce --}}
    {{-- <script src="{{asset('js/tinymce.min.js')}}"></script> --}}
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
          selector: '.textarea_content',
          menubar:false
        });
    </script>
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

                    <a class="navbar-item" href="#">
                      <span class="icon"><i class="fa fa-sign-out"></i></span>
                      Logout
                    </a>

                  </div>
                </div>

              @endif


            </div>

          </div>
        </nav>

        <!--Side Menu-->
        <div class="side-menu m-l-30 p-t-20">
          <aside class="menu">
            <p class="menu-label">
              General
            </p>
            <ul class="menu-list">
              <li><a href="{{route('manage.dashboard')}}">Dashboard</a></li>
            </ul>

            <p class="menu-label">
              Content
            </p>
            <ul class="menu-list">
              <li><a href="{{route('posts.index')}}">Manage Posts</a></li>
            </ul>

            <p class="menu-label">
              Adminstration
            </p>
            <ul class="menu-list">
              <li><a href="{{route('users.index')}}">Manage Users</a></li>
              <li><a href="#">Roles &amp; Permissions</a></li>
            </ul>
          </aside>
        </div>


        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- @include('_includes.notifications.toast') --}}
    @yield('scripts')
</body>
</html>