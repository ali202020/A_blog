
<nav class="navbar is-transparent" role="navigation" aria-label="main navigation">
  <div class="container">
    <div class="navbar-brand">
      <a class="navbar-item" href="{{route('home')}}">
        <img src="{{ asset('images/final.png') }}" alt="Elshazly_logo">
      </a>

      <a href="#" class="navbar-item is-tab is-hidden-mobile">Categories</a>
      <a href="#" class="navbar-item is-tab is-hidden-mobile">Blog</a>

      {{-- Start Of Search Bar section --}}
      <div class="navbar-item search-box">
        <input class="input is-small search-bar" type="text" placeholder="Find On the Blog">
        <ul class="panel search-results">
          {{-- <li class="panel-block">hi</li> --}}          
        </ul>
      </div>
      {{-- End Of Search Bar section --}}


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
            {{Auth::user()->name}}
          </a>

          <div class="navbar-dropdown">
            <a class="navbar-item" href="#">
              <span class="icon"><i class="fa fa-user-circle"></i></span>
                 &nbsp;Profile
            </a>
            <a class="navbar-item" href="#">
              <span class="icon"><i class="fa fa-bell"></i></span>
               &nbsp;Notifications
            </a>
            <a class="navbar-item" href="{{route('manage.dashboard')}}">
              <span class="icon"><i class="fa fa-cog"></i></span>
                 &nbsp;Manage Posts and Comments
            </a>
            <hr class="navbar-divider">
            {{-- ************************************ --}}
            {{-- **********   logout Form    ******** --}}
            {{-- ************************************ --}}
            <a class="navbar-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <span class="icon"><i class="fa fa-sign-out"></i></span>
               &nbsp;Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            {{-- ************************************** --}}
          </div>
        </div>
      @endif
    </div>
  </div>
</nav>
