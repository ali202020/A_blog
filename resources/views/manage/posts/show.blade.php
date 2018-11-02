@extends('layouts.app')
@section('content')
  <div class="container">
    {{-- *******  Start of Flash Message  ********--}}
    @if (session('status'))
        <article class="message is-success flash-message">
          <div class="message-header msg-content is-success">
            {{ session('status') }}
          </div>
        </article>
    @endif
    {{-- *******  End of Flash Message  ********--}}


    {{-- ************************************ --}}
    {{-- *******  Start of Post tile  ********--}}
    {{-- *************************************--}}
    <div class="tile is-ancestor post-tile m-t-5">
      <div class="tile is-parent is-10 is-vertical">
        <div class="tile is-child box">
          <p class="title">{{$post->title}}</p>
          <p class="subtitle">
            BY : {{$post->user->name}}&nbsp;&nbsp;&nbsp;
            Published at : {{$post->published_at}}
          </p>
          {{-- Start Of Post Content --}}
          <p>
            {!! $post->content !!}
          </p>

          {{-- Only authenticated user who is the owner of the post is the only one who can edit it --}}
          <br>
          @if (Auth::check() && Auth::user()->id == $post->user->id)
            <small>
              <a href="{{route('posts.edit',['slug'=>$post->slug])}}" class="edit-link">
                <i class="fa fa-edit"></i>&nbsp;Edit Post
              </a>
              &nbsp;.&nbsp;
              {{-- Start Of Delete Form --}}
              {{-- <button type="submit" class="button is-danger is-rounded">Delete&nbsp;<i class="fa fa-trash"></i></button> --}}
              <a class="delete-link" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                <i class="fa fa-trash"></i>&nbsp;Delete Post
              </a>
              <form id="delete-form" action="{{route('posts.destroy',['slug'=>$post->slug])}}" method="POST" role="form" class="card-footer-item" style="display: none;">
                {{ csrf_field() }}
                {{ method_field('DELETE')}}
              </form>
              {{-- End Of Delete Form --}}
            </small>
          @endif
          {{-- ****************************************** --}}
          {{-- ********  Start Of Comments Section  ******--}}
          {{-- ****************************************** --}}
          <hr>
          <p class="subtitle">Comments : </p>
          <article class="media">
            <figure class="media-left">
              <p class="image is-64x64">
                <img src="https://bulma.io/images/placeholders/128x128.png">
              </p>
            </figure>
            <div class="media-content">
              <div class="content">
                <p>
                  <strong>Barbara Middleton</strong>
                  <br>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porta eros lacus, nec ultricies elit blandit non. Suspendisse pellentesque mauris sit amet dolor blandit rutrum. Nunc in tempus turpis.
                  <br>
                  <small><a>Like</a> · <a>Reply</a> · 3 hrs</small>
                </p>
              </div>

              <article class="media">
                <figure class="media-left">
                  <p class="image is-48x48">
                    <img src="https://bulma.io/images/placeholders/96x96.png">
                  </p>
                </figure>
                <div class="media-content">
                  <div class="content">
                    <p>
                      <strong>Sean Brown</strong>
                      <br>
                      Donec sollicitudin urna eget eros malesuada sagittis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam blandit nisl a nulla sagittis, a lobortis leo feugiat.
                      <br>
                      <small><a>Like</a> · <a>Reply</a> · 2 hrs</small>
                    </p>
                  </div>

                  <article class="media">
                    Vivamus quis semper metus, non tincidunt dolor. Vivamus in mi eu lorem cursus ullamcorper sit amet nec massa.
                  </article>

                  <article class="media">
                    Morbi vitae diam et purus tincidunt porttitor vel vitae augue. Praesent malesuada metus sed pharetra euismod. Cras tellus odio, tincidunt iaculis diam non, porta aliquet tortor.
                  </article>
                </div>
              </article>

              <article class="media">
                <figure class="media-left">
                  <p class="image is-48x48">
                    <img src="https://bulma.io/images/placeholders/96x96.png">
                  </p>
                </figure>
                <div class="media-content">
                  <div class="content">
                    <p>
                      <strong>Kayli Eunice </strong>
                      <br>
                      Sed convallis scelerisque mauris, non pulvinar nunc mattis vel. Maecenas varius felis sit amet magna vestibulum euismod malesuada cursus libero. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus lacinia non nisl id feugiat.
                      <br>
                      <small><a>Like</a> · <a>Reply</a> · 2 hrs</small>
                    </p>
                  </div>
                </div>
              </article>
            </div>
          </article>

          {{-- Only Registered Users Who can leave A Comment --}}
          @if (Auth::check())
            <article class="media">
              <figure class="media-left">
                <p class="image is-64x64">
                  <img src="https://bulma.io/images/placeholders/128x128.png">
                </p>
              </figure>
              <div class="media-content">
                <div class="field">
                  <p class="control">
                    <textarea class="textarea" placeholder="Add a comment..."></textarea>
                  </p>
                </div>
                <div class="field">
                  <p class="control">
                    <button class="button is-primary">Post comment</button>
                  </p>
                </div>
              </div>
            </article>
          @else
            <article class="media">

              <div class="media-content">
                <div class="field">
                  <p class="control">
                    To Leave A Comment You Must Be Logged In
                    <a href="{{route('login')}}">Login</a>

                    Or , Join Us Now If You Are Not Already A Member
                    <a href="{{route('register')}}">Sign Up</a>

                  </p>
                </div>
              </div>
            </article>
          @endif
          {{-- ********  End Of Comments Section  ******--}}
        </div>
      </div>

      {{-- ************************************--}}
      {{-- ***  Start Of Create Post Widget ***--}}
      {{-- *********************************** --}}
      <div class="tile is-parent is-2">
        <div class="tile is-child box">
          @if (Auth::check())
            <a href="{{route('posts.create')}}" class="button is-primary">Create New Post</a>
          @else
            <a class="button is-primary" title="Please Login To Create A Post" disabled>Create New Post</a>
          @endif
        </div>
      </div>
      {{-- ***  End Of Create Post Widget ***--}}
    </div>
  </div>

@endsection
